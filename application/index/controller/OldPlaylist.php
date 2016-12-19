<?php
/**
 * ------ktv------
 * Author: Liu
 * Date: 2016/11/15 15:59
 * Version: 1.0
 */
namespace app\index\controller;

use app\index\Model\OldPlaylistModel;
use think\Db;

class OldPlaylist extends Base{
    public function _initialize(){

    }

    public function index() {
        return array('status'=>2000, 'message'=>'PlaylistController', 'data'=>'');
    }

    /**
     * 点歌
     * @param string $uid       用户账号
     * @param string $roomid    房间号
     * @param string $songid    歌曲号
     * @return array|\Exception
     */
    public function add($uid = '1', $roomid = '1',$songid = '1'){
        $playlist = new PlaylistModel;
        $is_set = $playlist->where(array('r_id'=>$roomid, 's_id'=>$songid, 'u_id'=>$uid))->find();
        if ($is_set){
//            return array('status'=>5000, 'message'=>'已存在');
            return $this->_return(302,'已存在');
        }
        //开启事务
        Db::startTrans();
        try{
            $time = date('Y-m-d H:i:s');
            //插入点歌
            Db::table('ktv_room_playlist')->insert(['r_id' => $roomid, 's_id' => $songid, 'u_id' => $uid, 'time'=>$time, 'rank'=>'0']);
            //添加历史记录
            Db::table('ktv_user_history')->insert(['s_id'=>$songid, 'u_id'=>$uid, 'create_time' => $time]);
            //提交事务
            Db::commit();
        } catch (\Exception $e){
            //回滚事务
            Db::rollback();
            //返回错误信息
            return $this->_return(401,'wrong', array('error'=>$e));
        }
        return $this->_return(200,'ok');
    }

    /**
     * 查看播放列表
     * @param string $roomid    房间id
     * @return array
     */
    public function show($roomid = '1'){
        $list = new PlaylistModel();
        $data = $list->where('r_id',$roomid)->order('rank', 'desc')->select();
        return $this->_return(200,'ok',$data);
    }

    public function delete($uid = '', $roomid = '',$songid = ''){
        //判断用户是否存在
        $playlist = new PlaylistModel;
        $is_set = $playlist->where(array('r_id'=>$roomid, 's_id'=>$songid, 'u_id'=>$uid))->find();
        if(!$is_set) {
            return $this->_return(403, '暂无记录');
        }
        $is_set->delete();
        return $this->_return(200, 'ok');
//        $db->delete($songid);
    }
    //置顶歌曲
    public function up(){
        //可以用队列 取出要置顶的歌曲 放到队首即可保留原来的置顶过的顺序
        return array('status'=>200, 'message'=>'ok', 'data'=>'');
    }
    
    public function test_show(){

    }
}