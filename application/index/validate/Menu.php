<?php


namespace app\index\validate;


use think\Validate;

class Menu extends Validate
{
    protected $rule= [
        'title|菜单名称'=>'require',
    ];
}