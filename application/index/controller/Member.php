<?php
/**
 * *******************************
 * ktv
 * Author: Liu
 * Date: 2016/12/8 21:43
 * Version: 1.0
 *********************************
 */

namespace app\index\controller;
use app\index\model\RoomMemberModel;
use app\index\model\RoomModel;
use think\Exception;

class Member extends Base{
    /**
     * 成员加入房间
     * @param string $roomid
     * @param string $uid
     * @param string $passwd
     * @return \think\response\Json
     */
    public function join($roomid = '',$uid = '', $passwd = ''){
        if(!$roomid || !$uid || !$passwd){
            return $this->_return(400,'参数错误');
        }
        //先查看房间状态, 是否开启
        $room = RoomModel::get($roomid);
        //如果房间开启并且密码相同
        if(isset($room) && ($room->status == 1)) {
            if($passwd != $room->passwd){
                return $this->_return(403,'密码错误');
            }
            //将用户存入数据库
            try {
                $member = new RoomMemberModel;
                $member->r_id = $roomid;
                $member->u_id = $uid;
                $member->join_time = date('Y-m-d H:i:s');
                $member->save();
                return $this->_return(200,'ok');
            }catch (\Exception $e){ //获取异常
                return $this->_return(203,'重复加入房间');
            }
        }else{
            //房间不存在,加入失败
            return $this->_return(404,'房间不存在');
        }
    }
    /**
     * 用户退出房间
     * @param string $roomid
     * @param string $uid
     * @return \think\response\Json
     */
    public function quit($roomid = '', $uid = ''){
        if(!$roomid || !$uid){
            return $this->_return(400,'参数错误');
        }
        //查找房间
        $room = RoomModel::get($roomid);
        //查找该成员
        $member = RoomMemberModel::get(array('r_id'=>$roomid, 'u_id'=>$uid));
        if(!isset($room) || !isset($member)){
            return $this->_return(404,'房间不存在或不在房间内');
        }
        try {
            //退出
            $member->delete();
        }catch (\Exception $e){ //异常
            return $this->_return(401,'退出房间异常');
        }
        return $this->_return(200,'ok');
    }
}