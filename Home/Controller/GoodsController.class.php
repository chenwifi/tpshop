<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-21
 * Time: 下午7:55
 */
namespace Home\Controller;
use Think\Controller;


class GoodsController extends Controller{

    public $cm;

    public function __construct(){
        parent::__construct();
        $this->cm = D('Admin/Cat');
    }

    public function comment(){
        //var_dump($_POST);exit;
        if(IS_POST){
            $_POST['pubtime'] = time();
            $data = $_POST;
            $commentModel = D('Comment');
            if(!$commentModel->create()){
                echo $commentModel->getError();
                exit;
            }
            if($commentModel->add($data)){
                $this->success('评论成功','',2);
            }else{
                $this->error('评论失败','',2);
            }
        }
    }

    public function goods(){
        //var_dump(array(array('ag'),NULL));exit;
        $goodsModel = D('Admin/goods');
        $goodsinfo = $goodsModel->find(I('goods_id'));

        if($goodsinfo){
            $this->history($goodsinfo);
        }

        //$CommentModel = D('Comment');
        //$come = $CommentModel->where(array('goods_id'=>I('goods_id')))->select();
        //var_dump($come);

        $com = $goodsModel->relationGet('Comment');
        //var_dump($com);exit;

        $com['content'] = htmlspecialchars($com['content']);

        $this->assign('goodsinfo',$goodsinfo);
        $this->assign('mbx',array_reverse($this->mbx($goodsinfo['cat_id'])));
        $this->assign('com',$com);

        //var_dump(session('history'));exit;

        $this->display();
    }

    public function history($goodsinfo){
        $goods_name = $goodsinfo['goods_name'];
        $shop_price = $goodsinfo['shop_price'];
        $goods_id = $goodsinfo['goods_id'];
        //print_r($goods_name);
        $history = session('?history')?session('history'):array();

        if(isset($history[$goods_id])){
            unset($history[$goods_id]);
        }

        $history[$goods_id] = array('goods_name'=>$goods_name,'shop_price'=>$shop_price);
        if(count($history)>3){
            $key = key($history);
            unset($history[$key]);
        }



        session('history',$history);
        //print_r($_SESSION);exit;
    }

    public function gwc(){
        $goodsinfo = D('Admin/Goods')->find(I('get.goods_id'));
        //var_dump($goodsinfo);exit;
        $tool = \Home\Tool\AddTool::getIns();
        $tool->add($goodsinfo['goods_id'],$goodsinfo['goods_name'],$goodsinfo['shop_price']);
        var_dump(session('kache'));//总是慢一步
    }

    public function mbx($cat_id){
        $fm = array();
        if($cat_id<=0)
            return $fm;

        foreach($this->cm->select() as $v){
            if($v['cat_id']==$cat_id){
                $fm[] = $v;//var_dump($fm);
                $fm = array_merge($fm,$this->mbx($v[parent_id]));
                break;
            }
        }
        return $fm;
    }
}