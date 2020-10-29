<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\index\CinemaModel;//电影
use App\model\index\SeatModel;//座位
class CinemaController extends Controller
{
   public function index(Request $request){
       $sid = $request->sid;
       $seatInfo = SeatModel::where('sid',1)->first();
       //dd($seatInfo);
       if(is_object($seatInfo)){
           $seatInfo = $seatInfo->toArray();
       }
        //dd($seatInfo);
       // 剩余库存
       $film_count = $seatInfo['film_count'];
       //dd($film_count);
       $str = [];
       for($i = 1;$i<=$film_count;++$i){
           $str[] = [
               'seat_num'  =>$i,
           ];
       }
       //dd($str);
       // 根据电影 id 查询当前电影已经购买当前座位号
       $seatInfo = SeatModel::where('sid',1)->get();
       //dd($seatInfo);
       if(is_object($seatInfo)){
           $seatInfo = $seatInfo->toArray();
       }
       //dd($seatInfo);
       $seat_num = [];
       foreach ($seatInfo as $k=>$v){
           $seat_num[] = $v['seat_num'];
       }
      // dd($seat_num);
       return view('index/goods/cinema',['seatInfo'=> $str,'seat_num'=>$seat_num]);
   }
   public function add(Request $request){
       $data=$request->except('_token');
       dd($data);
   }
}
