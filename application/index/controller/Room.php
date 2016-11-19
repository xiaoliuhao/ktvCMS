<?php
/**
 * *********ktv*******
 * Author: Liu               *
 * Date: 2016/11/15 19:53         *
 * Version: 1.0                  *
 *********************************
 */
namespace app\index\controller;
use app\index\Model\PlaylistModel;
use app\index\model\RoomModel;
use app\index\model\RoomMemberModel;
use think\Db;
use think\Exception;

class Room extends Base{
    public function _initialize(){}
    public function index(){
        return "RoomController";
    }

    /**
     * 创建房间
     * @param string $name  房间名字
     * @param string $uid   用户账号
     * @return array|\Exception
     */
    public function add($name = '123', $uid = '1'){
        $str = '';
        for ($i = 0; $i <= 6; $i++){
            $str .= rand(0,9);
        }
        $passwd = $str;
        Db::startTrans();
        try{
            $time = date('Y-m-d H:i:s');
            $id = Db::table('ktv_room')->insertGetId(['name'=>$name, 'passwd'=>$passwd, 'creater'=>$uid, 'status'=>1,'create_time'=>$time]);
            Db::table('ktv_room_member')->insert(['r_id'=>$id, 'u_id'=>$uid, 'level'=>0, 'join_time'=>$time]);
            Db::commit();
        } catch (\Exception $e){
            Db::rollback();
            return $e;
        }
        return $this->_return(200,'ok');
    }

    /**
     * 查看附近的房间
     * @return \think\response\Json
     */
    public function show(){
        $room = new RoomModel;
        $list = $room->where('status', '0')->select();
        return $this->_return(200,'ok',$list);
    }

    /**
     * 关闭房间
     * @param string $roomid
     * @param string $uid
     * @return \think\response\Json
     */
    public function close($roomid = '', $uid = ''){
        //查看用户权限是否足够
        $members = new RoomMemberModel;
        $rooms    = new RoomModel;
        $member  = $members->get(array('u_id'=>$uid,'r_id'=>$roomid));
        //不是创建者, 无权关闭该房间
        if($member->level != 0){
            return $this->_return(404,'权限不足');
        }else{
            //找到对应的房间,删除
            $room = $rooms->getByr_id($roomid);
            $room->delete();
            return $this->_return(200,'ok');
        }
    }

    /**
     * 成员加入房间
     * @param string $roomid
     * @param string $uid
     * @param string $passwd
     * @return \think\response\Json
     */
    public function addMember($roomid ='',$uid = '', $passwd = ''){
        //先查看房间状态, 是否开启
        $room = RoomModel::get($roomid);
        //如果房间开启并且密码相同
        if(isset($room) && ($room->status == 1)) {
            if($passwd != $roomid){
                $this->_return(403,'密码错误');
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
                return $this->_return(403,'请勿重复加入房间');
            }
        }else{
            //房间不存在,加入失败
            return $this->_return(404,'您所加入的房间不存在');
        }
    }

    /**
     * 用户退出房间
     * @param string $roomid
     * @param string $uid
     * @return \think\response\Json
     */
    public function deleteMember($roomid = '', $uid = ''){
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
            return $this->_return(403,'退出房间错误');
        }
        return $this->_return(200,'ok');
    }

}