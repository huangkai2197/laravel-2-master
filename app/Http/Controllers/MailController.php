<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {

        $yzm = "";
        for($i=0;$i<4;$i++)
        {
            $a = rand(0,9); //0-9随机数
            $yzm.= $a;
        }
        $email=$request->get('email');
        Mail::raw($yzm, function ($message)use ($email){
            // * 如果你已经设置过, mail.php中的from参数项,可以不用使用这个方法,直接发送
            // $message->from("1182468610@qq.com", "laravel学习测试");
            $user=$email;
            $message->subject("测试的邮件主题");
            // 指定发送到哪个邮箱账号
            $message->to($user);
        });

        return $yzm ?
            json_success('获取邮箱成功!', $yzm, 200) :
            json_fail('获取邮箱失败!', null, 100);


    }
}
