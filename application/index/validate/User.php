<?php


namespace app\index\validate;


use think\Validate;

class User extends Validate
{
    protected $rule=[
        'mobile|手机号'=>'number|length:11',
        'card|卡号'=>'number|unique:user',
        'car|车牌号'=>'require|chsAlphaNum|unique:user'
    ];
}