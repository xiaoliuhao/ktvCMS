<?php
/**
 * *********ktv*******
 * Author: Liu               *
 * Date: 2016/11/15 19:18         *
 * Version: 1.0                  *
 *********************************
 */

namespace app\index\model;
use think\Model;

class UserHistoryModel extends Model{
    protected $table = 'ktv_user_history';

    protected $createTime = 'create_time';
    protected $autoWriteTimestamp = 'datetime';
}