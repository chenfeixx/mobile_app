<?php
/**
 * Created by PhpStorm.
 * User: chenfei
 * Date: 2017/7/19
 * Time: 13:18
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    //设置表名
    public $table = 'artseed_class';
    //去除自带管理列
    public $timestamps = false;

}