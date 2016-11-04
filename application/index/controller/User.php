<?php
/**
 * Created by PhpStorm.
 * User: Liu
 * Date: 2016/11/1
 * Time: 21:30
 */
namespace app\index\controller;

//调用Request类
use \think\Request;
//调用User模型
use app\index\model\UserModel;

class User{

    public function _initialize(){

    }

    public function login(){
        $uid = Request::instance()->get('uid');
        $passwd = Request::instance()->get('passwd');

        $user = new UserModel();

        $data = $user->check_login($uid, $passwd);
        return $data;
    }
    
    public function register(){
        
    }
}