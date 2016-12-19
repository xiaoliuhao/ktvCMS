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
use app\index\model\SingerModel;

class Playlist extends Base{
    public function _initialize(){

    }

    public function index() {
        return array('status'=>2000, 'message'=>'PlaylistController', 'data'=>'');
    }

    public function show(){
        $list = new PlaylistModel;
        return $list->field('title,artist,album,cover,lyric,mp3,ogg')->select();
    }

    public function add($id){
        //获取歌曲的详情
        $tool = new SearchModel;
        $playlist = new PlaylistModel;
        $url = "http://music.163.com/api/song/detail/?id=" . $id . "&ids=%5B" . $id . "%5D";
        $json = $tool->curl_get($url);
        $data = json_decode($json);
        $song = $data->songs[0];
        $music = array(
//            'id'    => $song->id,
            'title'  => $song->name,
            'artist' => $song->artists[0]->name,
            'album'  => $song->album->name,
            'cover'  => $song->album->picUrl,
            'lyric'  => '',
            'mp3'    => $song->mp3Url
        );
        $playlist->title = $music['title'];
        $playlist->artist = $music['artist'];
        $playlist->album  = $music['album'];
        $playlist->cover  = $music['cover'];
        $playlist->lyric  = $music['lyric'];
        $playlist->mp3    = $music['mp3'];
        if($playlist->save()) {
            //添加到点歌记录

            return $this->_return(200, 'ok', $music);
        }
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
}