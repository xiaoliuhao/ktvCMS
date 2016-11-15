<?php
/**
 * *********ktv*******
 * Author: Liu               *
 * Date: 2016/11/15 19:53         *
 * Version: 1.0                  *
 *********************************
 */
namespace app\index\controller;
use app\index\model\RoomModel;
use app\index\model\RoomMemberModel;
use think\Db;

class Room{
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
            $id = Db::table('ktv_room')->insertGetId(['name'=>$name, 'passwd'=>$passwd, 'creater'=>$uid, 'create_time'=>$time]);
            Db::table('ktv_room_member')->insert(['r_id'=>$id, 'u_id'=>$uid, 'level'=>0, 'join_time'=>$time]);
            Db::commit();
        } catch (\Exception $e){
            Db::rollback();
            return $e;
        }
        return array('status'=>200, 'message'=>'ok');
    }

    /**
     * 查看附近的房间
     * @return array
     */
    public function show(){
        $room = new RoomModel;
        $list = $room->where('status', '0')->select();
        return array('status'=>200, 'message'=>'ok', 'data'=>$list);
    }

    /**
     * 关闭房间
     * @param string $roomid
     * @param string $uid
     */
    public function close($roomid = '', $uid = ''){
        //查看用户权限是否足够
        //关闭房间
    }
    
    public function addMember($uid='', $roomid =''){
        return array('status'=>200,'ok', 'data'=>$data);
    }

    public function deleteMember(){
        
        return array('status'=>200, 'message'=>'ok', 'data'=>'');
    }

}