<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-8
 * Time: 上午10:48
 */

namespace Admin\Controller;
use Think\Controller;

class CatController extends Controller{
    public function cateadd(){
       if(IS_POST){
           $catmodel = D('Cat');
           echo $catmodel->add($_POST)?'ok':'false';
       }
        $this->display();
    }

    public function cateedit(){
        $catmodel = D('Cat');

        if(IS_POST){
            //print_r($_POST['cat_id']);
            //print_r($_POST);
            $id = I('cat_id');
            if($catmodel->where('cat_id=' . $id)->save($_POST)){
                $this->redirect('Admin/Cat/catelist');
                exit;
            }
        }

        $this->assign('catinfo',$catmodel->find(I('cat_id')));
        $this->assign('gettree',$catmodel->Gettree());
        $this->display();
    }

    public function catelist(){
        $catmodel = D('Cat');
        $cat = S('cat');
        //S('cat',null);exit;
        if(!$cat){
            echo 1;
            $cat = $catmodel->Gettree();
            S('cat',$cat,10);
        }

        $this->assign('catelist',$cat);
        $this->display();
    }

    public function catedel(){
        $id = I('cat_id');
        $catmodel = D('Cat');
        if($catmodel->delete($id)){
            $this->redirect('Admin/Cat/catelist');
        }
    }
}