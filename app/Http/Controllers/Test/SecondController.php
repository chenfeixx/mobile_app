<?php
namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Created by PhpStorm.
 * User: chenfei
 * Date: 2017/7/19
 * Time: 15:50
 */
class SecondController extends Controller
{
    public function showtest()
    {
        $result = DB::select("SELECT * FROM artseed_users");
        return response()->json($result);
    }
    //支持post 和get
    public  function mulitem(Request $request)
    {
        if($request->isMethod('post')){
            return "this is a post request";
        }
        if($request->isMethod('get')){
            return "this is a get request";
        }

        //数据事物处理
        DB::transaction(function (){

        });

        DB::beginTransaction();
    }
}