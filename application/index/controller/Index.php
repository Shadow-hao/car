<?php
namespace app\index\controller;
use app\index\model\Index as model;
class Index extends Base
{
    public function index()
    {
        //获取用户权限
        $where = model::get_right(session('admin')['gid']);

        $data = model::get_menu($where);
        $this->assign('title','名车养护');
        $this->assign('data',$data);
        return $this->fetch();
    }
    //欢迎页面
    public function welcome(){
        $data1['users'] = model::count_user();
        $data1['recharge'] =model::sum_recharge();
        $data1['balance'] = model::sum_balance();
        $data1['money'] = model::sum_money();
        $data1['integral'] = model::sum_integral();
        $this->assign('data1',$data1);
        return$this->fetch();
    }
}
