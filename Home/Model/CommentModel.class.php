<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-4-13
 * Time: 上午11:47
 */

namespace Home\Model;
use Think\Model;

class CommentModel extends Model{
    //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
    public $_validate = array(
        array('email','email','邮箱格式错误',1,'',3),
        array('content','30,200','评论至少十个字',1,'length',3)
    );
}