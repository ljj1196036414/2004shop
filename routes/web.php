<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/','Index\GoodsController@index');
//登录
;
Route::get('user/login','Index\UserController@login');
Route::post('user/loginInfo','Index\UserController@loginInfo');
Route::get('user/sign','Index\UserController@sign');
//发送邮箱
Route::get('user/sendEmali','Index\UserController@sendEmali');
Route::get('user/enrolll/{key}','Index\UserController@enroll');

//githod
Route::get('user/githod','Index\UserController@githod');



//注册
Route::get('user/register','Index\UserController@register');
Route::post('user/registerinfo','Index\UserController@registerinfo');
Route::get('user/hello','Index\UserController@hello');
//首页
Route::get('goods/index','Index\GoodsController@index');
Route::get('goods/search','Index\GoodsController@search');
Route::get('goods/item','Index\GoodsController@item');
Route::get('goods/iteminfo','Index\GoodsController@iteminfo');
//ajax 购物车
Route::get('goods/car','Index\GoodsController@car');
//订单
Route::get('goods/order','Index\GoodsController@order');
Route::get('goods/cart','Index\GoodsController@cart');
Route::get('goods/add','Index\GoodsController@add');
//收藏
Route::get('/goods/fav','Index\GoodsController@fav');
//商品描述
Route::get('/goods/comment','Index\GoodsController@comment');
Route::post('/goods/commentinsert','Index\GoodsController@commentinsert');
Route::get('/goods/commentindex','Index\GoodsController@commentindex');
//个人中心
Route::get('goods/personal','Index\GoodsController@personal');
Route::get('goods/personalindex','Index\GoodsController@personalindex');
//支付
Route::get('pay/ali','Index\PayController@aliPay');
//电影院
Route::get('cin/index','Index\CinemaController@index');
Route::get('cinema/add','Index\CinemaController@add');
//抽奖
Route::get('pirve/index','Index\PirveController@index');
Route::get('pirve/add','Index\PirveController@add');
//递归 波那契数列第 n 项
Route::get('pirve/digui','Index\PirveController@test');


Route::get('goods/getMany','Index\GoodsController@getMany');
Route::get('goods/guzzleIesr1','Index\GoodsController@guzzleIesr1');


//微信
Route::any('user/index','UserController@index');
Route::any('/weixin','WeixinController@wxEvent'); //接收事件推送
Route::any('weixin2','WeixinController@weixin2'); // 获取access_token
Route::any('createmanu','WeixinController@createmanu'); // 菜单
Route::get('receive','WeixinController@receive'); // 菜单
Route::get('receiveEvent','WeixinController@receiveEvent'); // 菜单
Route::get('gettext','WeixinController@gettext'); // 文本处理
Route::get('shouquan','WeixinController@shouquan'); // 微信授权
Route::any('/code','WeixinController@codes'); // 获取code
Route::post('tianqi','WeixinController@tianqi'); // 天气
Route::any('check','WeixinController@check'); // 天气