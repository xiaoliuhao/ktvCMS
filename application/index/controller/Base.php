<?php
/**
 * Created by PhpStorm.
 * User: Liu
 * Date: 2016/11/17
 * Time: 23:49
 */
namespace app\index\controller;

/**
 * Class Base
 * @package app\index\controller
 */
class Base  {
    /**
     * return 自定义返回模板
     * @param $code
     * @param $message
     * @param $data
     * @return \think\response\Json
     */
    protected function _return($code, $message, $data = ''){
        return json(['msg' => $message, 'data'=>$data], $code);
    }
}