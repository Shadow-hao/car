<?php


namespace app\index\controller;


use think\Controller;

class Base extends Controller
{
    protected $_admins;
    public function __construct()
    {
        parent::__construct();
        //是否登录
        $this->_admins = session('admin');
        if (!$this->_admins){
            header('location: /index/account/login');
            exit();
        }
    }

}