<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-4-5
 * Time: 下午8:58
 */


function jm($a){
    return md5($a);
}

function check($id){
    $user = D('Home/User/User');
    $info = $user->find($id);
    return jm(cookie('username') . $info['password'] . C('COO_KIE')) === cookie('key');
}