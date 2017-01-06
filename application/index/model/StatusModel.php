<?php
/**
 * *******************************
 * ktv
 * Author: Liu
 * Date: 2016/12/19 22:40
 * Version: 1.0
 *********************************
 */
namespace app\index\model;
use think\Model;

class StatusModel extends Model{
    protected $table = 'ktv_status';

    public function update_status($value){
        $status = $this->get(1);
        $status->status = $value;
        $status->save();
    }
}