<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-3-9
 * Time: 下午4:44
 */

namespace Admin\Model;
use Think\Model;

class CatModel extends Model{
    public function Gettree($p = 0,$lev = 0){
        //var_dump($this->select(false));exit;
        $t = array();
        foreach($this->select() as $k=>$v){
            //$t = array();
            if($v['parent_id'] == $p){
                $v['lv'] = $lev;
                $t[] = $v;
                $t = array_merge($t,$this->Gettree($v['cat_id'],$lev+1));
            }
        }
        return $t;
    }
}