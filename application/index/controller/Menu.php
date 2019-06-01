<?php


namespace app\index\controller;
use app\index\model\Menu as Mmodel;
class Menu extends Base
{
    //菜单列表
    public function index(){
        $pid = (int)input('get.pid');
        if ($back_id =(int)input('get.back_id') ){
            $p_data = Mmodel::get($back_id);
            $pid =$p_data['pid'];
        }
        $data = Mmodel::where('pid',$pid)->order('order','asc')->order('id','asc')->select();
//        $c_menu =0;
//        if ($data_c = Mmodel::where('pid','>',0)->column('pid')){
//            $c_menu =1;
//        }
        // 获取所有有子菜单的ID
        // 获取所有的ID
        $data_c = Mmodel::column('id');
        $list=[];
        foreach ($data_c as $k=>$v){
            // dump($v);
            //获取所有有子ID的ID
            if ($p_data = Mmodel::where('pid',$v)->column('id')){
                //dump($p_data);
                //创建索引与值相同的数组
                $list[$v]= $v;
                //  dump($v);
            }

        }

        $this->assign('list',$list);
        $this->assign('pid',$pid);
        $this->assign('data',$data);
//        $this->assign('c_menu',$c_menu);
        return $this->fetch();
    }
    //菜单添加
    public function add(){

        if ( $data = input('post.')){
            $validate = validate('menu');
            if (!$validate->check($data)) {
                return ['code'=>1,'message'=>$validate->getError()];
            }
            if(!$menu = Mmodel::create($data)){
                return ['code'=>2,'message'=>'数据添加失败'];
            }
            return ['code'=>0,'message'=>'菜单添加成功'];
        }else{
            return $this->fetch();
        }


    }
    //添加子菜单
    public function add_c(){
        if ($pid = input('get.id')) {
            $menu = Mmodel::get($pid);
            $this->assign('menu',$menu);
            return $this->fetch();
        }
        if ($data = input('post.')){
            $validate = validate('Menu');
            if (!$validate->check($data)) {
                return ['code'=>1,'message'=>$validate->getError()];
            }
            if (!$menu= Mmodel::create($data)){
                return ['code'=>2,'message'=>'子菜单添加失败'];
            }
            return ['code'=>0,'message'=>'子菜单添加成功'];
        }

    }
    //删除分类
    public function del(){
        $id = (int)input('post.id');
        if (!Mmodel::destroy($id)){
            return ['code'=>1,'message'=>'删除失败请重试'];
        }
        //查找当前分类下是否有子类有就删除
        if ($c_menu =Mmodel::where('pid', $id)->find()){
            if (!Mmodel::where('pid',$id)->delete()){
                return ['code'=>2,'message'=>'子分类删除成功'];
            }
        }

        return ['code'=>0,'message'=>'删除成功'];
    }
    //编辑分类
    public function edit(){
        if ($id=  input('get.id')) {
            $menu = Mmodel::get($id);
            $this->assign('menu',$menu);
            return $this->fetch();
        }
        if ($data = input('post.')){
            if (!$menu = Mmodel::get($data['id'])){
                return ['code'=>2,'message'=>'菜单修改失败'];
            }
            if (!isset($data['status'])){
                $data['status']=0;
            }
            if (!isset($data['ishidden'])){
                $data['ishidden']=0;
            }

            if($menu->save($data)){
                return ['code'=>0,'message'=>'菜单修改成功'];
            }
            return ['code'=>5,'message'=>'菜单未做修改'];
//         if (!$menu= Mmodel::create($data)){
//             return ['code'=>2,'message'=>'菜单修改失败'];
//         }
        }

    }
}