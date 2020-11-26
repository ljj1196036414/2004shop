<?php

namespace App\Http\Controllers\Werixin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\model\GoodsModel;
//use App\model\UsersModel;
use App\UserModel;
use App\model\CartModel;
class ApiController extends Controller
{
    public function __construct(){
       app('debugbar')->disable();
    }
    public function userInfo(){
        echo __METHOD__;
    }
    public function test(){
        $goods_info=[
            'goods_id'=>1234,
            'goods_name'=>"IPHONE",
            'price'=>12.34
        ];
       echo json_encode($goods_info);
    }
    public function wxlogin(Request $request){
        $code=$request->get('code');//获取code
       // dd($code);
        //接收用户信息
        $userinfo=json_decode(file_get_contents("php://input"),true);
        $url='https://api.weixin.qq.com/sns/jscode2session?appid='.env('WX_XCX_APPID').'&secret='.env('WX_XCX_APPSECRET').'&js_code='.$code.'&grant_type=authorization_code';
       //dd($url);
        $data=json_decode(file_get_contents($url),true);
        //dd($data);
        if(isset($data['errcode'])){//失败
            $response=[
                'erron'=>5001,
                'msg'=>'登录失败',
            ];
        }else{   //成功
            $openid=$data['openid'];
           // dd($openid);
            $u=UserModel::where(['openid'=>$openid])->first();
            //dd($u);
            if($u){
                //TODO 老用户
                $uid = $u->id;
            }else{
                $u_info=[
                    'openid'      =>$openid,
                    'nickname'    =>$userinfo['u']['nickName'],
                    'sex'         =>$userinfo['u']['gender'],
                    'language'    =>$userinfo['u']['language'],
                    'city'        =>$userinfo['u']['city'],
                    'province'    =>$userinfo['u']['province'],
                    'country'      =>$userinfo['u']['country'],
                    'headimgurl'  =>$userinfo['u']['avatarUrl'],
                    'add_time'     =>time(),
                    'type'         =>3
                ];
                UserModel::insertGetId($u_info);
               //dd($aa);
            }

             $token = sha1($data['openid'] . $data['session_key'].mt_rand(0,999999));
            //保存token
            $redis_login_hash = 'h:xcx:login:'.$token;

           $login_info = [
                'uid' => $uid,
                'user_name' => "",
                'login_time' => date('Y-m-d H:i:s'),
                'login_ip' => $request->getClientIp(),
                'token' => $token,
                'openid'    => $openid
            ];

            //保存登录信息
            Redis::hMset($redis_login_hash, $login_info);
            // 设置过期时间
            Redis::expire($redis_login_hash, 7200);

            $response = [
                'errno' => 0,
                'msg'   => 'ok',
                'data'  => [
                    'token' => $token,
                   'openid'=>$data['openid']
                ]
            ];
        }

        echo json_encode($response);die;
    }
    //列表展示
    public function leibiao(Request $request){
        $inate=config('app.pageSize');
        $res=GoodsModel::select('goods_id','goods_name','goods_img','shop_price')->limit(10)->get()->toArray();
        //dd($res);
        return $res;

    }
    //详情页面
    public function lest(Request $request){
        $token=$request->get('access_token');
        //var_dump($token);die;
        $token_key='h:xcx:token:'.$token;
        //var_dump('key:'.$token_key);die;
        $status=Redis::exists($token_key);
//       if($status==0)
//        {
//           $response=[
//               'errno'=>40003,
//               'msg'=>'未授权'
//           ];
//           return $response;
//       }

        $id = request()->goods_id;
        //dd($id);
       $res=GoodsModel::where(['goods_id'=>$id])->first()->toArray();
       //dd($res);
       return $res;
    }
    //列表
    public function goodslest(Request $request){
        $inate=config('app.pageSize');
        $res=GoodsModel::select('goods_id','goods_name','goods_img','shop_price')->paginate($inate)->toArray();
        $response=[
            'errno'=>0,
            'msg'=>'ok',
            'data'=>[
                'data'=>$res
            ]
        ];
        return $response;
    }
    //加入购物车
    public function cart(Request $request){
        $data = $request->all();
        //dd($goods_id);
        $uid = $_SERVER['uid'];

        $where=[
            'goods_id'=>$data['goods_id']
        ];
        $price = GoodsModel::find($data['goods_id'])->shop_price;
        //var_dump($goods);die;
        $login_info = [
                'goods_id'       => $data['goods_id'],
                'goods_num'=>1,
                'uid'     =>$uid,
                'add_time'    => date('Y-m-d H:i:s'),
                'shop_price'=>$price

            ];
        //dd($login_info);
        $res=CartModel::insert($login_info);
        if($res){
            //TODO 添加成功
            $response = [
                'errno' => 0,
                'msg'   => 'ok',
            ];

        }else{
            //TODO  添加失败
            $response = [
                'errno' => 500000000,
                'msg'   => '失败',
            ];
        }
        return $response;
    }
    //购物车列表
    public function cartlist(Request $request){
       $uid=$_SERVER['uid'];

       $goods=CartModel::leftjoin('p_goods','p_goods.goods_id','=','p_cart.goods_id')->where('p_cart.uid',$uid)->get()->toArray();
       //dd($goods);

        if(!empty($goods)){
            //TODO 成功
            $cart_return=[
                'errno'=>0,
                'msg'=>'ok',
                'data'=>$goods
            ];
        }else{
            //TODO 失败
            $cart_return=[
                'errno'=>5000000,
                'msg'=>'失败',
            ];
        }
        return $cart_return;
    }
    //收藏
    public function collection(Request $request){
        $goods_id=$request->all(['goods_id']);
       // dd($goods);
       $uid= $_SERVER['uid'];
       //用户收藏的商品有序集合  ss有序集合的意思
       $redis_key='ss:goods:fav:'.$uid;
        //将商品id加入有序集合，并给排序值
       Redis::Zadd($redis_key,time(),$goods_id);
       $response=[
           'errno'=>0,
           'msg'=>'ok'
       ];
       return $response;
    }
}
