<?php
/**
 * Created by PhpStorm.
 * User: Liu
 * Date: 2016/10/26
 * Time: 22:59
 */
namespace app\index\model;
use think\Model;

class UserModel extends Model {
    // 设置当前模型对应的完整数据表名称
    protected $table = 'ktv_user';

    // 设置当前模型的数据库连接
    protected $connection = [
        // 数据库类型
        'type'        => 'mysql',
        // 服务器地址
        'hostname'    => '127.0.0.1',
        // 数据库名
        'database'    => 'ktvcms',
        // 数据库用户名
        'username'    => 'root',
        // 数据库密码
        'password'    => '',
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => 'ktv_',
        // 数据库调试模式
        'debug'       => false,
    ];

    public function check_login($uid, $passwd){
        $user = new UserModel;
        $data = $user->where('u_id', $uid)->find();
        return $data;
    }
}