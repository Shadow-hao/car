<?php


namespace app\index\controller;
use app\index\model\Integral as model;

class Integral extends Base
{
    public function index(){
        $data = model::all();
        $this->assign('data',$data);
        return $this->fetch();
}
    public function add(){
        return $this->fetch();
    }
    public function save(){
        $data = input("post.");
        // $data['balance']=$data['recharge'];


        if(!$res = model::create($data)){
            return ['code'=>2,'message'=>'数据插入失败'];
            exit();
        }
        return ['code'=>0,'message'=>' 类目添加成功'];
    }
    //编辑
    //分类编辑
    public function edit(){

        if ($id = input('get.id')){
            $data = model::get($id);
            $this->assign('data',$data);
            return $this->fetch();
        }
        if ($post = input('post.')){
            $data = model::get($post['id']);
            $data->name = $post['name'];
            $data->order = $post['order'];
            $data->price = $post['price'];
            if (!$data->save()){
                return ['code'=>1,'message'=>' 类目更新失败'];
                exit();
            }
            return ['code'=>0,'message'=>' 类目更新成功'];
        }

    }
    //类目删除
    public function del(){
        $id = input('post.id');
        if (!!model::destroy($id)){
            return ['code'=>0,'message'=>'类目删除成功'];

        } else{
            return ['code'=>1,'message'=>'类目删除失败'];
        }

    }
}