<?php
/**
 * Created by PhpStorm.
 * User: Liu
 * Date: 2016/11/17
 * Time: 23:49
 */
namespace app\index\controller;
use think\controller;

class Base extends controller{
    protected function _return($code, $message, $data){
        return array('status'=>$code, 'message'=>$message, 'data'=>$data);
    }
}