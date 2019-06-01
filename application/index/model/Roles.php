<?php


namespace app\index\model;


use think\Db;
use think\Model;

class Roles extends Model
{
    protected $pk='id';
    protected $autoWriteTimestamp = false;
    public static function get_menu(){
       $data = Db::table('menu')->order('order','desc')->select();
        $list=[];
        foreach ($data as $k=>$v){
            $list[$v['id']]=$v;
        }

       return $data;
    }
}