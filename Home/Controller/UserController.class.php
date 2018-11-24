<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-21
 * Time: 下午7:56
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
    public function login(){
        //echo check(2);exit;
        if(IS_POST){
            $username = I('post.username');
            //var_dump($username);exit;
            $pwd = I('post.password');
            $code = I('post.yzm');

            $user = D('User');
            $userinfo = $user->where(array('username'=>$username))->find();
            //var_dump($userinfo);exit;
            if(!$userinfo){
                //exit('用户名错误');
                $this->error('用户名错误','',3);
            }

            if($userinfo['password'] !== md5($pwd . $userinfo['salt'])){
                $this->error('密码错误','',3);

            }

            //$Verify = new \Think\Verify();
            /*if(!$Verify->check($code)){
                $this->error('验证码错误','',3);
            }*/

            cookie('username',$userinfo['username']);
            cookie('userid',$userinfo['user_id']);
            $coo_kie = jm($userinfo['username'] . $userinfo['password'] . C('COO_KIE'));
            cookie('key',$coo_kie);
            $this->success('登录成功',U('Home/index/index'),2);
            exit;

        }
        $this->display();
    }

    public function logout(){
        //cookie(null);
        cookie('username',null);
        cookie('userid',null);
        cookie('key',null);
        $this->success('退出成功',U('Home/index/index'),2);
    }

    public function yzm(){
        $Verify = new \Think\Verify();
        $Verify->length = 3;
        $Verify->fontSize = 30;
        $Verify->entry();
    }

    public function msg(){
        $this->display();
    }

    public function reg(){
        if(IS_POST){
            //var_dump($_POST);exit;
            $user = D('User');
            if(!$user->create()){
                exit($user->getError());
            }

            //var_dump($user->password);exit;

            $s = $this->yan();
            $user->password = md5($user->password . $s);
            $user->salt = $s;
            $user->add();

            //var_dump($_POST);exit;
        }


        $this->display();
    }

    public function yan(){
        $arr = 'abcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($arr),0,8);
    }
}