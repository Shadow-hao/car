<?php


namespace app\index\controller;

use app\index\model\Item as model;
class Item extends Base
{
    public function index(){
        if (!$data = model::order('order','desc')->order('id','desc')->select()){
            $this->error('类目数据获取失败');
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    //分类添加
    public function add(){
        return $this->fetch();
    }
    //分类保存
    public function save(){
        $data = input("post.");
        // $data['balance']=$data['recharge'];


        if(!$res = model::create($data)){
            return ['code'=>2,'message'=>'数据插入失败'];
            exit();
        }
        return ['code'=>0,'message'=>' 类目添加成功'];
    }
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