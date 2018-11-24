<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-8
 * Time: 上午10:56
 */

namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller{
    public $goodsmodel;
    public function __construct(){
        parent::__construct();
        $this->goodsmodel = D('goods');
    }

    public function goodsadd(){
        if(IS_POST){
            //var_dump($_POST);exit;
            //print_r($_POST['goods_name']);
            //echo $this->goodsmodel->add($_POST)?'1':'0';
            if(!$this->goodsmodel->create()){
                exit($this->goodsmodel->getError());
            }else{
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728 ;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Upload/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                // 上传文件
                $info = $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功
                    //$this->success('上传成功！');
                    //var_dump($info);
                    $this->goodsmodel->goods_img = './Upload/' . $info['goods_img']['savepath'] . $info['goods_img']['savename'];

                    $image = new \Think\Image();
                    $image->open($this->goodsmodel->goods_img);
                    $img_small = './Upload/thumb/' . $info['goods_img']['savename'];
                    $image->thumb(150,150)->save($img_small);
                    $this->goodsmodel->thumb_img = $img_small;
                }
                echo $this->goodsmodel->add()?'1':'0';
            }
        }


        $this->display();
    }

    public function goodslist(){

        //$User = M('User'); // 实例化User对象
        $count = $this->goodsmodel->count();// 查询满足要求的总记录数
        //var_dump($count);
        $Page = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        //var_dump($show);
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $this->goodsmodel->cache(true)->order('goods_id')->limit($Page->firstRow.','.$Page->listRows)->select();
        //var_dump($list);exit;
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板分页
    }

    public function del(){
        //echo I('get.id');exit;
        $this->goodsmodel->delete(I('get.id'));
        $this->redirect('admin/goods/goodslist');
    }
}