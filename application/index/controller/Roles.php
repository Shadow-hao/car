<?php


namespace app\index\controller;
use app\index\model\Roles as model;

class Roles extends Base
{
    public function index(){
        $data = model::all();
        $this->assign('data',$data);
        return$this->fetch();
    }
    //角色添加
    public function add(){
        if ($data = input("post.")){
            $vlidata =validate('Roles');
            if (!$vlidata->check($data)){
                return ['code'=>1,'message'=>$vlidata->getError()];
            }
            $data1['name'] = $data['name'];
            $data1['right']= implode(',',array_keys($data['right']));
            if(!$res = model::create($data1)){
                return ['code'=>2,'message'=>'数据插入失败'];
                exit();
            }
            return ['code'=>0,'message'=>' 类目添加成功'];
        }
        $data= model::get_menu();
        // print_r($data);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //编辑角色
    public function edit(){
        if ($post = input('post.')){
            if (isset($post['right'])){
                $data1['right']= implode(',',array_keys($post['right']));
            }
            $data1['name'] = $post['name'];
          if (!$res= model::where('id',$post['id'])->update($data1)) {
              return ['code'=>1,'message'=>' 角色更新失败'];
          }
            return ['code'=>0,'message'=>' 角色更新成功'];
        }
        $id=(int)input('get.id');
        $roles = model::get($id);
        $data= model::get_menu();
        $right=explode(',',$roles['right']);
        $list=[];
        foreach ($right as $v){
            $list[$v]=$v;
        }

        $this->assign('data',$data);
        $this->assign('roles',$roles);
        $this->assign('right',$list);
        return $this->fetch();
    }
    //删除
    public function del(){
        $id = (int)input('post.id');
        if (!$res = model::destroy($id)){
            return ['code'=>1,'message'=>' 删除失败'];
        }
        return ['code'=>0,'message'=>' 删除成功'];
    }

}