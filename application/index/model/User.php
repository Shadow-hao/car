<?php


namespace app\index\model;


use think\Db;
use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp=true;
    public static function set_list($data){
        //充值记录
        $list['user_id']=$data['id'];
        $list['recharge']=$data['recharge'];
        $list['create_time']=time();

      if (!$data = Db::table('recharge_list')->insert($list)) {
          return false;
      }
      return true;
    }
    //获取充值记录
    public static function getRecharge_list($id,$order=['id','desc']){
        if ( !!$res = Db::table('recharge_list')->where('user_id',$id)->order($order[0],$order[1])->paginate(3)){
            return $res;
        }else{
            return false;
        }
    }
    //获取充值总金额
    public static function sum($id){
        $res =   Db::table('recharge_list')->where('user_id',$id)->sum('recharge');
        return $res;
    }
    public static function del_list($id){
        //删除单条充值记录
        if ( !!$res = Db::table('recharge_list')->where('id',$id)->delete()){
            return $res;
        }else{
            return false;
        }
    }
    //获取消费项目
    public static function get_item(){
        if ( !!$res = Db::table('item')->select()){
            return $res;
        }else{
            return false;
        }
    }
    //生成消费记录表
    public static function balance_list($data){
        if ( !!$res = Db::table('balance_list')->data($data)->insert()){
            return $res;
        }else{
            return false;
        }
    }
    //生成积分消费记录表
    public static function integral_list($data){
        if ( !!$res = Db::table('integral_list')->data($data)->insert()){
            return $res;
        }else{
            return false;
        }
    }
    //获取积分项目
    public static function get_integral(){
        if ( !!$res = Db::table('integral')->select()){
            return $res;
        }else{
            return false;
        }
    }
    //获取消费记录
    public static function getBalance_list($id,$order=['id','desc']){
        // dump($id);
        if ( !!$res = Db::table('balance_list')->where('user_id',$id)->order($order[0],$order[1])->paginate('10')){
            return $res;
        }else{
            return false;
        }
    }
    //获取积分兑换记录
    public static function getintegral_list($id,$order=['id','desc']){
        // dump($id);
        if ( !!$res = Db::table('integral_list')->where('user_id',$id)->order($order[0],$order[1])->paginate('10')){
            return $res;
        }else{
            return false;
        }
    }
    //获取消费总金额
    public static function sum_b($id){
        $res =   Db::table('balance_list')->where('user_id',$id)->sum('balance');
        return $res;
    }
    public static function del_balance($id){
        //删除单条消费记录
        if ( !!$res = Db::table('balance_list')->where('id',$id)->delete()){
            return $res;
        }else{
            return false;
        }
    }
    public static function del_balances($id){
        //删除会员时消费记录
        if ( !!$res = Db::table('balance_list')->where('user_id',$id)->delete()){
            return $res;
        }else{
            return false;
        }
    }
    //删除积分兑换记录
    public static function del_integral($id){
        //删除会员时消费记录
        if ( !!$res = Db::table('integral_list')->where('id',$id)->delete()){
            return $res;
        }else{
            return false;
        }
    }
    public static function delRecharge($id){
        //删除会员时删除充值记录
        if ( !!$res = Db::table('recharge_list')->where('user_id',$id)->delete()){
            return $res;
        }else{
            return false;
        }
    }

}