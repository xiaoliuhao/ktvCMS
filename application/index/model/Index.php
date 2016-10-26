<?php
/**
 * Created by PhpStorm.
 * User: Liu
 * Date: 2016/10/26
 * Time: 22:58
 */
namespace app\index\model;

use think\Model;

class Index extends Model
{

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
}