<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\index\CouponModel;
class CouponController extends Controller
{
    public function index(){
        return view('coupon/index');
    }
    public function add(Request $request){
        $type=$request->get('type');
        dd($type);
        switch ($type){
            case 1:
                $this->coupon100_20();
                break;
            case 2:
                $this->coupon200_40();
                break;
            case 3:
                $this->coupon400_60();
                break;
            default:
                echo "参数错误";
                break;
        }
        $respinse=[
            'erron'=>0,
            'msg'=>'ok'
        ];
        return $respinse;
    }
    public function coupon100_20(){
        $uid=session('user.uid');
        $begin_time=strtotime('2020_11_1');//优惠券的使用时间
        $expire_time=strtotime(date("Y-m-d",strtotime("+9day")));
        $data = [
            'uid'           => $uid,
            'add_time'      => time(),
            'begin_time'    => $begin_time,
            'expire_time'   => $expire_time,
            'type'          => 1,           // type=1  满100 - 20
        ];
        CouponModel::insertGetId($data);
    }
}
