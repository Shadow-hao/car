<?php


namespace app\index\controller;

use think\Controller;
use app\index\model\Account as model;
class Account extends Controller
{
    //登录界面
    public function login(){
        if (session('?admin')){
            $this->error('你已经登录,请退出后再试');
            exit();
        }
        $this->assign('title','登录');
        return $this->fetch();
    }
    //登录操作
    public function doLogin()
    {
        $data = input('post.');
        $validate = validate('Account');
        if (!$validate->check($data)) {
            return ['code' => 2, 'message' => $validate->getError()];
        }
       $admins = model::where('username', $data['username'])->find();
        if (!$admins){
            return ['code' => 3, 'message' => '用户不存在'];
        }
        if (!(md5($data['password']) == $admins['password'])){
            return ['code' => 1, 'message' => '密码错误'];
        }
        if ($admins['status'] == 1){
            return ['code' => 4, 'message' => '账号已被禁用'];
        }
       $admins= $admins->hidden(['create_time','update_time','password'])->toArray();
        //设置用户session
        //dump($admins);
        session('admin', $admins);
        return ['code' => 0, 'message' => '验证通过'];

    }
    //退出
    public function logout(){
        session(null);
        if (session('admins')){
            return ['code' => 1, 'message' => '退出失败请重试'];
        }else{
            return ['code' => 0, 'message' => '退出成功'];
        }
    }
    //管理员列表
    public function a_list(){
        $data = model::all();
        $roles = model::get_roles();
        $this->assign('data',$data);
        $this->assign('roles',$roles);
        return$this->fetch();
    }
    //添加管理员
    public function add(){
        if($data = input('post.')){
            $validate =validate('account');
            if (! $validate->scene('add')->check($data)){
                return ['code'=>1,'message'=>$validate->getError()];
            }
            if ($admin = model::where('username',$data['username'])->find()){
                return ['code'=>1,'message'=>'用户名已经存在更改后再试'];
            }
            $data['password']=md5($data['password']);
            if (model::create($data)) {
                return ['code'=>0,'message'=>'用户添加成功'];
            }
        }else{
            $groups = model::get_groups();
          //  dump($groups);
            $this->assign('data',$groups);
            return $this->fetch();
        }

    }
    //编辑管理员
    public function edit(){

        if ($data =input('post.')){
            $admin = model::get($data['id']);

            if (!($data['password'] == $admin['password'])){
                $data['password'] = md5(input('post.password'));
            }else{
                unset($data['password']);
            }
            //  dump($data);exit();
            $data['status'] = (int)input('post.status');
            if ($admin->save($data)){
                if (($data['id'] == session('admins')['id'])){
                    session(null);
                    return ['code'=>11,'message'=>'用户更新成功'];
                }
                return ['code'=>0,'message'=>'用户更新成功'];
            }
        }
        //dump(input('get.'));
        $id = input('get.id');
        $admin = model::get($id);
        $groups = model::get_groups();
        $this->assign('data',$groups);
        $this->assign('admins',$admin);
        return $this->fetch();
    }
    //删除管理员
    public function del(){
        $id = (int)input('post.id');
        if (!model::destroy($id)){
            return ['code'=>1,'message'=>'删除失败请重试'];
        }
        return ['code'=>0,'message'=>'删除成功'];
    }
}