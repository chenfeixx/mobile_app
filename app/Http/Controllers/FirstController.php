<?php
/**
 * Created by PhpStorm.
 * User: chenfei
 * Date: 2017/7/19
 * Time: 10:08
 */

namespace App\Http\Controllers;


use App\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class FirstController extends Controller
{
    public function show($id)
    {
        $result = DB::select("SELECT * FROM artseed_users");
        return response()->json($result);
    }
    //post请求
    public function addclass(Request $request,$id)
    {

        $this->updateLocale($id);//修改env配置文件

        return $this->outPut(200,$request->input('name'));
    }

    //put请求
    public function putclass(Request $request)
    {
        $arrays = array();
        $arrays['code'] = 200;
        $arrays['msg']  = $request->input('name');
        $arrays['data'] = $request->input('id');
        return response()->json($arrays);
    }

    public function gettest(Request $request,$id)
    {

        //分页请求
        $result = ClassModel::all()->forPage(1,env('PAGE_NUM'));
        return response()->json($result);
    }
}