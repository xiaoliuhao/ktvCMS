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
    //构造函数
    public function _initialize(){

    }

    public function index(Request $request, $name = '') {
        $str = base64_encode('123');
        $data = ['name'=> $name, 'status'=>'1', 'str'=>$str];
        return json($data);
    }

    public function login($uid = '', $passwd = ''){

        if($uid && $passwd) {
            $str = array('uid' => $uid, 'passwd' => $passwd);
            return $str;
        }else{
            return 'wrong';
        }

//        $user = new UserModel();
//
//        $data = $user->check_login($uid, $passwd);
//        return $data;
    }
    
    public function register(){
        
    }
}