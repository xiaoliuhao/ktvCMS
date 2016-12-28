<?php
/**
 * *******************************
 * ktv
 * Author: Liu
 * Date: 2016/12/19 15:26
 * Version: 1.0
 *********************************
 */
namespace app\index\controller;

use app\index\model\PlaylistModel;
use app\index\model\SearchModel;
use app\index\model\HistoryModel;
use app\index\model\StatusModel;

class Playlist extends Base{

    public function show(){
        $list = new PlaylistModel;
        $status = new StatusModel;
        $data['list'] = $list->field('id as pid,title,artist,album,cover,lyric,mp3,ogg')->select();
        $sta           = $status->get(1);
        $data['status'] = $sta['status'];
        $sta->status = 0;
        $sta->save();

        return $data;
    }

    public function _initialize(){

    }

    public function index() {
        return array('status'=>2000, 'message'=>'PlaylistController', 'data'=>'');
    }

    //添加歌曲之后要添加一个标记, 获取列表的时候返回新的列表
    public function add($id){
        if(is_array($id)){
            foreach ($id as $item){
                $info = $this->_add($item);
            }

            return $this->_return(200,'ok');
        }else {
            $music = $this->_add($id);
            if (!$music) {
                return false;
            } else {
                return $this->_return(200, 'ok', $music);
            }
        }
    }

    public function delete($pid){
        $playlist = new PlaylistModel;
        $data = $playlist->get($pid);
        $data->delete();

        return $this->_return(200,'ok');
    }

    public function add_list($list){
        $json = $list;
        $data = json_decode($json);

        foreach ($data as $song){
            $info = $this->_add($song);
        }
        return $this->_return(200,'ok',json_decode($list));
    }

    /**
     * 获取歌词
     * @param $id
     * @return mixed
     */
    public function get_lyric($id){
        $url = "http://music.163.com/api/song/lyric?os=pc&id=" . $id . "&lv=-1&kv=-1&tv=-1";
        $data = $this->curl_get($url);
        $result = $data->lrc->lyric;
        return $result;
    }


    /**
     * @param $url
     * @return mixed
     */
    private function curl_get($url){
        $model = new SearchModel;
        $json = $model->curl_get($url);
        $data = json_decode($json);
        return $data;
    }

    private function _add($id){
        //获取歌曲的详情
        $tool = new SearchModel;
        $playlist = new PlaylistModel;
        $history = new HistoryModel;
        $url = "http://music.163.com/api/song/detail/?id=" . $id . "&ids=%5B" . $id . "%5D";
        $json = $tool->curl_get($url);
        $data = json_decode($json);
        $song = $data->songs[0];
        $music = array(
            'id'    => $song->id,
            'title'  => $song->name,
            'artist' => $song->artists[0]->name,
            'album'  => $song->album->name,
            'cover'  => $song->album->picUrl,
            'lyric'  => $tool->get_lyric($song->id),
            'mp3'    => $song->mp3Url
        );
        $playlist->s_id   = $music['id'];
        $playlist->title  = $music['title'];
        $playlist->artist = $music['artist'];
        $playlist->album  = $music['album'];
        $playlist->cover  = $music['cover'];
        $playlist->lyric  = $music['lyric'];
        $playlist->mp3    = $music['mp3'];
        if($playlist->save()) {
            //添加到点歌记录
            $history->id     = $song->id;
            $history->title  = $music['title'];
            $history->artist = $music['artist'];
            $history->album  = $music['album'];
            $history->cover  = $music['cover'];
            $history->lyric  = $music['lyric'];
            $history->mp3    = $music['mp3'];
            $history->time   = date('Y-m-d H:i:s');
            if($history->save()) {
                $status = new StatusModel;
                $status->update_status(1);
                return $music;
            }
        }else{
            return false;
        }
    }
    
    public function test(){
        $status = new StatusModel;

        $data = $status->update_status(1);

        return $data;
    }
}