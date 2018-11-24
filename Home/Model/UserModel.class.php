<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-26
 * Time: 上午10:54
 */

namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    public $_validate = array(
        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        array('username','3,8','用户名必须在3到8个字符间',1,'length',3),
        array('email','email','邮箱格式不对',1,'',3),
        array('password','/\b\w{6,}\b/','密码必须多于六位',1,'regex',3),
        array('repwd','password','确认密码与原密码不一致',1,'confirm',3),
        array('username','','用户名已经存在',1,'unique',1)
    );
}