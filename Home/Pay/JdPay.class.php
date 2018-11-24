<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 17-4-11
 * Time: 下午8:27
 */
namespace \Home\Pay;

class JdPay{
    protected $v_amount;
    protected $v_oid;

    protected $v_moneytype = 'CNY';

    /* *
     *       这些可以写进配置选项 *
     *  */

    protected $v_mid;
    protected $v_url;
    protected $v_key;

    public function __construct($v_amount,$v_oid){
        $this->v_amount = $v_amount;
        $this->v_oid = $v_oid;

        $this->v_mid = C('V_MID');
        $this->v_url = C('V_URL');
        $this->v_key = C('V_KEY');
    }

    public function form(){
        $form = '
               <form method="post" action="第三方提供的网址">
               <input type="text" name="v_amount" vlaue="%s">
               <input type="submit" value="支付">
               </form>
        ';
        return sprintf($form,$this->v_amount);
    }

    public function sign(){
        $str = $this->v_amount . $this->v_moneytype . $this->v_oid . $this->v_mid . $this->v_url . $this->v_key;
        return strtoupper(md5($str));
    }

}