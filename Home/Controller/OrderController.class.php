<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-21
 * Time: 下午7:56
 */
namespace Home\Controller;
use Think\Controller;

class OrderController extends Controller{
    public function checkout(){
        $kache = session('kache');
        $tool = \Home\Tool\AddTool::getIns();
        $this->assign('zj',$tool->calcMoney());
        $this->assign('kache',$kache);
        $this->display();
    }
    public function done(){
        $this->display();
    }
}