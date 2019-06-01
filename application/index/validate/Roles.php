<?php


namespace app\index\validate;


use think\Validate;

class Roles extends Validate
{
    protected $rule=[
        'name|角色名称'=>'require|alphaNum',

    ];
//    protected $scene=[
//        'add'=>['username','password'],
//    ];

}