<?php


namespace app\index\validate;


use think\Validate;

class Account extends Validate
{
    protected $rule=[
        'username|用户名'=>'require|alphaNum',
        'password|密码'=>'require|alphaNum|length:5,12',
        'captcha|验证码'=>'require|captcha',
    ];
    protected $scene=[
        'add'=>['username','password'],
    ];
}