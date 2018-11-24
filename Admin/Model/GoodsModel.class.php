<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-13
 * Time: 上午10:28
 */

namespace Admin\Model;
//use Think\Model;
use Think\Model\RelationModel;

class GoodsModel extends RelationModel{

    protected $_link = array(
        'Comment'=>self::HAS_MANY
    );

    protected $_validate = array(
        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        array('goods_name','3,6','长度不合适',1,'length',3),
        array('goods_sn','','不能重复',1,'unique',3),
        array('shop_price','checkprice','我们不会卖这么贵的商品',1,'function',3)
    );

    protected $_auto = array(
        //array(完成字段1,完成规则,[完成条件,附加规则]),
        array('add_time','time',3,'function')
    );

    protected $insertFields = 'goods_name,goods_sn,goods_weight,goods_desc';

    public function checkprice(){
        return false;
    }
}