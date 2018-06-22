<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


define("ROUNT_BASE",'/index.php');

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get(ROUNT_BASE.'/foo', function () {
    return 'Hello World';
});

//get请求
$app->get(ROUNT_BASE.'/fshow/{id}', 'FirstController@show');
//post请求
$app->post(ROUNT_BASE.'/fadd/{id}','FirstController@addclass');
//put请求
$app->put(ROUNT_BASE.'/fput','FirstController@putclass');

//get请求带请求参数的
$app->get(ROUNT_BASE.'/gettest/{id}','FirstController@gettest');

//带命名空间的路由设置
$app->group(['namespace' => 'App\Http\Controllers\Test'],function () use ($app){
    //get请求
    $app->get(ROUNT_BASE.'/testshow', 'SecondController@showtest');
    //get请求和post都支持
    $app->bag(ROUNT_BASE.'/getorpost','SecondController@mulitem');
});




