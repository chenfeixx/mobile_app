<?php

namespace App\Http\Controllers;



use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Merchant;
use EasyWeChat\Payment\Order;
use EasyWeChat\Payment\Payment;
use Illuminate\Support\Facades\Lang;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /*
     * 修改项目语言设置
     *
     * */
    public function updateLocale($lanage)
    {
        //App::setLocale($id);  lumen 设置无效
        //config(['app.locale' => $id]);  lumen 设置无效

        apache_setenv('APP_LOCALE',$lanage); //修改env配置文件
    }

    /*
     * 用户认证
     *
     * */
    public function authUser($lanage)
    {

    }

    /*
     * 格式化响应结果集  json字符串
     *
     * */
    public function outPut($code,$data=null)
    {
        $result = array();
        $result['code'] = $code;
        $result['msg']  = Lang::get('message.'.$code);
        $result['data'] = null == $data ? "":$data;
        return response()->json($result);
    }

    /**
     * 微信支付 公众号支付、扫码支付、APP支付
     * @return $config
     * @param $out_trade_no 订单号  $body 商品名称  $detail 商品描述
     * $total_fee 商品总金额（单位分） $trade_type 支付类型   JSAPI，NATIVE，APP...
     */
    public function weChart($out_trade_no,$body,$detail,$total_fee,$trade_type = 'JSAPI',$openid='')
    {
        $app = new Application(config('wechart_option'));
        $payment = $app->payment;
        $attributes = [
            'trade_type'       => $trade_type, // JSAPI,APP...
            'body'             => $body,
            'detail'           => $detail,
            'out_trade_no'     => $out_trade_no,
            'total_fee'        => $total_fee, // 单位：分
            'notify_url'       => 'http://xxx.com/order-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $openid, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        //创建订单
        $order = new Order($attributes);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }else{
            $this->outPut(100);
        }
        if($trade_type == 'JSAPI'){
            $config = $payment->configForJSSDKPayment($prepayId);
        }else if($trade_type == 'APP'){
            $config = $payment->configForAppPayment($prepayId);
        }else{
            $this->outPut(101);
        }

        return $config;
    }
}
