<?php
/**
 * Created by PhpStorm.
 * User: chenfei
 * Date: 2017/7/20
 * Time: 16:33
 */

namespace App\Http\Controllers;


use EasyWeChat\Foundation\Application;

class WechartNotify extends Controller
{
    public function notify()
    {

        $app = new Application(config('wechart_option'));
        $response = $app->payment->handleNotify(function($notify, $successful){
//            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
//            $order = 查询订单($notify->out_trade_no);
//            if (!$order) { // 如果订单不存在
//                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
//            }
//            // 如果订单存在
//            // 检查订单是否已经更新过支付状态
//            if ($order->paid_at) { // 假设订单字段“支付时间”不为空代表已经支付
//                return true; // 已经支付成功了就不再更新了
//            }
//            // 用户是否支付成功
//            if ($successful) {
//                // 不是已经支付状态则修改为已经支付状态
//                $order->paid_at = time(); // 更新支付时间为当前时间
//                $order->status = 'paid';
//            } else { // 用户支付失败
//                $order->status = 'paid_fail';
//            }
//            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }
}