<?php


namespace app\index\controller;


use app\index\model\Roles as model;
use think\Controller;
use app\index\model\Index;
use think\Db;

class Test extends Controller
{
    public function index(){
        $where = \app\index\model\Index::get_right(session('admin')['gid']);
        $data = Db::table('menu')->where('id','in',$where)->order('order','asc')->select();


        $data2= genTree(byId($data));
        $list=[];
        foreach ($data2 as $k=>$v){
            if (isset($v['son'])){
                foreach ($v['son'] as $v1){
                    $list[$v1['id']]=$v1['id'];
                }
            }


        }
        dump($list);
      dump(explode(',',$where));

    }
    public function index1(){
        $where = \app\index\model\Index::get_right(session('admin')['gid']);
        $data = Db::table('menu')->where('id','in',$where)->order('order','asc')->select();
        $data= byId($data);
        $data= genTree($data);
        print_r($data);
    }
}