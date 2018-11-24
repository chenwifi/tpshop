<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        //$tool = new \Home\Tool\AddTool;
        //var_dump($tool->user());exit;

        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $cat = D('Admin/Cat');
        $goodsmodel = D('Admin/Goods');
        $cattree = $cat->Gettree();
        //print_r($cattree);exit;
        //var_dump($list);exit;
        $hot = $goodsmodel->field('goods_name,goods_id,shop_price,market_price,goods_img,is_hot')->order('goods_id desc')->limit(0,4)->where('is_hot=1')->select();
        //var_dump($hot);exit;
        $this->assign('hot',$hot);
        //var_dump(array_reverse(session('history'),true) );exit;
        $this->assign('his',array_reverse(session('history'),true));

        $this->assign('cattree',$cattree);
        $this->display();
    }
}