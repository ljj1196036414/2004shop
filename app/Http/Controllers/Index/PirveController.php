<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\index\PirveModel;
class PirveController extends Controller
{
    public function index()
    {
        return view('index/goods/pirve');
    }

    public function add()
    {
        $this->uid = session('user.uid');
        //dd($this->uid);
        $uid = $this->uid;
        //dd($uid);
        if (empty($uid)) {
            $response = [
                'erron' => 4003,
                'msg' => '请先登录'
            ];
            return $response;
        }
        $pirve = PirveModel::get($uid)->value('many');
        if ($pirve) {
        }

        $time1 = strtotime(date("Y-m-d"));
        $res = PirveModel::where(['uid' => $uid])->where("time", ">=", $time1)->first();
        if ($res) {
            $response = [
                'errno' => 300008,
                'msg' => '您已抽过，明天再来'
            ];
            return $response;
        }
        $rand = mt_rand(1, 10000);
        $res1 = 0;
        $da = '没有中奖';
        if ($rand == 1) {
            $res1 = 1;
            $da = '一等奖';
        } elseif ($rand == 4 && $rand == 6) {
            $res1 = 2;
            $da = '二等奖';
        } elseif ($rand >= 7 && $rand <= 9) {
            $res1 = 3;
            $da = '三等奖';
        }
        $where = [
            'many' => $res1,
            'uid' => $uid,
            'time' => time()
        ];
        $pid = PirveModel::insert($where);
        if ($pid > 0) {
            $data = [
                'errno' => 0,
                'msg' => 'ok',
                'data' => [
                    'many' => $res1
                ]
            ];
        } else {
            $data = [
                'errno' => 500008,
                'msg' => "数据异常，请重试"
            ];
        }
        return $data;
    }

    //递归 波那契数列第 n 项
    function test(){
        function fbnqn($n)
        {  //定义求第n项函数
            if ($n == 1 || $n == 2) {   //如果等于1或2 返回1
                return 1;
            }
            return fbnqn($n - 1) + fbnqn($n - 2);//经典递归

        }
        echo fbnqn(10);
    }
        function fbnqs($n){//定义求第n项函数
            $sum=0;
            for($i=1;$i<=$n;$i++){
                $sum+=fbnqs($i);
            }
            return $sum;
        }


}