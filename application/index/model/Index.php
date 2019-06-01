<?php


namespace app\index\model;


use think\Db;
use think\Model;

class Index extends Model
{
    protected $table='menu';
    public static function get_right($where){
        $data = Db::table('roles')->where('id',$where)->column('right');
        $res= implode(',',$data);
        return $res;
    }
    public static function get_menu($where){
        $data = Db::table('menu')->where('id','in',$where)->order('order','asc')->select();
        $data= byId($data);
        $data= genTree($data);
       return $data;
    }
    //获取会员总数
    public static function count_user(){
        $res =   Db::table('user')->count();
        return $res;
    }
    //获取充值总金额
    public static function sum_recharge(){
        $res =   Db::table('user')->sum('recharge');
        return $res;
    }
    //获取消费总金额
    public static function sum_balance(){
        $res =   Db::table('user')->sum('balance');
        return $res;
    }
    //获取现金消费总金额
    public static function sum_money(){
        $res =   Db::table('user')->sum('money');
        return $res;
    }
    //获取现金消费总金额
    public static function sum_integral(){
        $res =   Db::table('user')->sum('integral');
        return $res;
    }





}