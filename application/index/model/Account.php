<?php


namespace app\index\model;


use think\Db;
use think\Model;

class Account extends Model
{
    protected $pk='id';
    protected $table='account';
    public static function get_roles(){
    $data = Db::table('roles')->column('name','id');
    return $data;
}
    public static function get_groups(){
        $data = Roles::all();
        return $data;
    }
}