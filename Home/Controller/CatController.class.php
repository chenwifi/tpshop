<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-21
 * Time: 下午7:55
 */
namespace Home\Controller;
use Think\Controller;

class CatController extends Controller{
    public function Cat(){
        if(!$_GET['p']){
            $_GET['p'] = 1;
        }

        $id = I('cat_id');
        $goodsModel = D('Admin/goods');
        //print_r($goodsModel);exit;
        $goodslist = $goodsModel->field('goods_id,goods_name,shop_price,market_price,goods_img')->where('cat_id=' . $id)->page($_GET['p'].',4')->select();
        //print_r($goodslist);exit;
        //var_dump($goodslist);exit;
        //$list = $goodsModel->field('goods_id,goods_name,shop_price,market_price,goods_img')->where('cat_id=' . $id)->select();
        $count = $goodsModel->field('goods_id,goods_name,shop_price,market_price,goods_img')->where('cat_id=' . $id)->count();
        $Page = new \Think\Page($count,4);
        $show = $Page->show();

        $this->assign('page',$show);
        $this->assign('goodslist',$goodslist);
        $this->assign('count',$count);


        $this->display();
    }
}