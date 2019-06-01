<?php


namespace app\index\controller;
use app\index\model\User as model;
class User extends Base
{
    public function index(){

        $order['0'] ='id';
        $order['1'] ='desc';
        $order1='id,desc';
        $where1='mobile';
        if ($post = input('post.')){
            $order1= $post['order'];
            $order = explode(",", $post['order']);

        }

    $data = model::order( $order['0'], $order['1'])->order('create_time','asc')->paginate();
        if ($get = input('get.')){
           $where= array_values($get);
           $where1=$where[0];
           $where2= $where[1];
           $data = model::where($where1,$where2)->paginate();
            //dump($data);
        }
        $this->assign('order1', $order1);
        $this->assign('select', $where1);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //添加会员
    public function add(){
        return $this->fetch();
    }
    //保存会员
    public function save(){
        $data = input('post.');
        if ($data){
            $validate= validate('User');
            if (!$validate->check($data)){
                return ['code'=>1,'message'=>$validate->getError()];
            }
            if (!$res = model::create($data)){
                return ['code'=>2,'message'=>'数据插入失败'];
            }
            return ['code'=>0,'message'=>'会员添加成功'];
        }
    }
    //充值
    function recharge(){
       if ($data = input('get.')) {
           $this->assign('data',$data);
           return $this->fetch();
       }

        if ($data1 = input('post.')){
            if (!$res = model::get($data1['id'])){
                return ['code'=>1,'message'=>"充值失败"];
            }
         $recharge = $res['recharge'] +$data1['recharge'];
            $res->recharge = $recharge;
            if(!$res->save()){
                return ['code'=>2,'message'=>"更新失败"];
            }
            //充值记录
            if (!$list= model::set_list($data1)){
                return ['code'=>3,'message'=>"充值记录写入失败"];
            }
            return ['code'=>0,'message'=>"充值成功"];
        }
    }
    //充值记录
    public function recharge_list(){
        $id = (int)input('get.id');
        if (!!$id) {
            if (!$res = model::getRecharge_list($id)) {
                // dump($res);
                $this->error('获取充值记录失败,请充值后查询');
            }
        }

        //设置默认排序
        $order1 = 'id,desc';
        if ($order = input('post.')) {
            $id = $order['id'];
            $order = $order['sex'];
            $order1 = $order;
            $order = explode(",", $order);

            $res = model::getRecharge_list($id, $order);
        }
        //分页
        $page = input('get.page');
        if (!!$page) {
            $page = input('get.');
            $order1 = $page['order'];
            $p_order = explode(",", $page['order']);
            // dump($page);
            $res = model::getRecharge_list($page['id'], $p_order);
        }
        $sum = model::sum($id);
        $this->assign('data', $res);
        $this->assign('id', $id);
        $this->assign('order1', $order1);
        $this->assign('sum', $sum);
        return $this->fetch();
    }
    //删除记录
    public function del_list()
    {
        $id = input('post.id');
        //dump('$id');
        if (!!model::del_list($id)) {
            return ['code' => 0, 'message' => '充值记录删除成功'];

        } else {
            return ['code' => 1, 'message' => '充值记录删除失败'];
        }
    }
    //会员扣款页面
    public function balance()
    {
        if ($id = input('get.')) {
            $res = model::get_item();
            $this->assign('item', $res);
            $this->assign('id', $id);
            return $this->fetch();
        }
        $balance = input('post.');
       $list['user_id']=(int)$balance['id'];
       $list['balance']=$balance['balance'];
       $list['create_time']=time();
       $list['balance_item']=implode(',',$balance['item']);
       $res= model::get($balance['id']);
       //dump(($res->recharge - $res->balance) >=$balance['balance'] );
       if (!(($res->recharge - $res->balance) >=$balance['balance'] ) ){
           return ['code'=>1,'message'=>'余额不足请充值'];
       }
       $res->balance =  $res->balance +$balance['balance'];
       $res->integral=  $res->integral +$balance['balance'];
       if (!$res->save()){
           return ['code'=>2,'message'=>'扣款失败'];
       }
       if (!(model::balance_list($list))){
           return ['code'=>3,'message'=>'生成消费记录失败'];
       }
        return ['code'=>0,'message'=>'扣款成功'];



    }
    //消费记录
    public function balance_list()
    {
        $id = input('get.id');
        //默认排序
        $order1 = 'id,desc';
        if (!!$id) {
            $order1 = explode(",", $order1);
            if (!$res = model::getBalance_list($id,$order1)) {
                //dump($res);
                $this->error('获取消费记录失败,消费记录为空');
            }
        }
        $order1 = 'id,desc';
        //分页
        //分页
        $page = input('get.page');
        if (!!$page) {
            $page = input('get.');
            $order1 = $page['order'];
            $p_order = explode(",", $page['order']);
            // dump($page);
            $res = model::getBalance_list($page['id'], $p_order);
        }
        //设置默认排序
        // $order1 = 'id,desc';
        if ($order = input('post.')) {
            $id = $order['id'];
            $order = $order['sex'];
            $order1 = $order;
            $order = explode(",", $order);

            $res = model::getBalance_list($id, $order);
        }
        $sum = model::sum_b($id);
        $this->assign('data', $res);
        $this->assign('id', $id);
        $this->assign('order1', $order1);
        $this->assign('sum', $sum);
        return $this->fetch();


    }
    //删除消费记录
    public function del_balance()
    {
        $id = input('post.id');

        //dump('$id');
        if (!!model::del_balance($id)) {
            return ['code' => 0, 'message' => '充值记录删除成功'];

        } else {
            return ['code' => 1, 'message' => '充值记录删除失败'];
        }
    }
    //会员删除页
    public function del()
    {
        $id = input('post.')['id'];

        if (!model::destroy($id)) {
            return ['code' => 2, 'message' => '会员删除失败'];

        }
        if (!model::delRecharge($id)) {
            return ['code' => 1, 'message' => '充值记录删除失败或充值记录不存在'];
        }
        if(model::del_Balances($id)){
            return ['code' => 3, 'message' => '会员消费记录删除失败'];
        }
        return ['code' => 0, 'message' => '会员删除成功'];

    }
    //现金消费
    public function balance1(){
        $balance = input('post.');
        if (empty($balance['item'])){
            return ['code'=>5,'message'=>'请选择扣款项目'];
        }
        $list['user_id']=(int)$balance['id'];
        $list['balance']=$balance['balance'];
        $list['create_time']=time();
        $list['balance_item']=implode(',',$balance['item']);
        $res= model::get($balance['id']);
        $res->money=$res->money +$balance['balance'];
        $res->integral=  $res->integral +$balance['balance'];
       if (!$res->save()) {
           return ['code'=>2,'message'=>'扣款失败'];
       }
        if (!(model::balance_list($list))){
            return ['code'=>3,'message'=>'生成消费记录失败'];
        }
        return ['code'=>0,'message'=>'扣款成功'];
    }

}