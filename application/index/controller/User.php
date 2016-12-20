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

class User extends Base {
    /**
     * 构造函数
     */
    public function _initialize(){

    }


    public function index() {
//        return array('status'=>2000, 'message'=>'UserController', 'data'=>'');
        return $this->_return(404,'ok','');
    }

    /**
     * 用户登录
     * @param string $uid       用户账号
     * @param string $passwd    密码
     * @return array
     */
    public function login($uid = '', $passwd = ''){
        //判断参数是否为空, 若参数不全则返回
        if(!$uid || !$passwd){
//            return array('status'=>4000,'message'=>'参数错误','data'=>'');
            return $this->_return(400,'参数错误');
        }
        //调用model
        $user = new UserModel();
        //查询用户数据
        $data = $user->where(array('u_id'=>$uid, 'passwd'=>$passwd))->find();
        //返回json字符串, status状态码  message 信息  data 数据
        return $this->_return(200,'ok',$data);
    }

    /**
     * 用户注册
     * @param string $uid       账号
     * @param string $username  昵称
     * @param string $passwd    密码
     * @return array
     */
    public function register($uid = '', $username = '', $passwd = ''){
        $user = new UserModel();
        if(!$uid || !$username || !$passwd){
            return $this->_return(400,'参数错误');
        }
        //判断该账号是否存在
        $data = $user->where(array('user_id'=>$uid))->find();
        if($data){
            return $this->_return(403,'该用户名已经被注册');
        }
        $user->user_id      = $uid;
        $user->user_name    = $username;
        $user->passwd       = $paswd;
        if($user->save()){
            $this->_return(200,'ok');
        }else {
            $this->_return(404, '数据库插入错误');
        }
    }


}