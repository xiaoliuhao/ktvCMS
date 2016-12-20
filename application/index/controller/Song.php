<?php
/**
 * Created by PhpStorm.
 * User: Liu
 * Date: 2016/11/12
 * Time: 22:11
 */
namespace app\index\controller;
use app\index\model\SongModel;
use app\index\model\SearchModel;

class Song extends Base{
    public function _initialize() {
        
    }

    public function index() {
        return "SongController";
    }

    public function add($title) {
        $db = new SongModel;
        $title_info = to_en($title);
        var_dump($title_info);
        $db->title = $title_info['name'];
        $db->short_title = $title_info['short_name'];
        $db->en_title    = $title_info['pinyin'];
        $db->album       = $album;
        $db->author      = $author;
        $db->mp3         = $mp3;

        if($db->save()){
            //添加成功
            return $this->_return(200, 'ok');
        }

    }

    public function get($type = ''){
        $db = new SongModel;
        if($type){
            $songs = $db->field('id,title,artist,album,type')->where(array('type'=>$type))->select();
        }else{
            $songs = $db->field('id,title,artist,album,type')->select();
        }
        return $this->_return(200, 'ok', $songs);
    }

    public function show($id = '', $name = '') {
        
    }

    public function play($songid='') {
        $this->_return(200,'ok',$data);
    }

    public function test() {
        $song = SongModel::get('S00001');
        $song->get('S00001');
        return $song;
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

    public function add_song($title, $type){
        //获取歌曲的详情
        $tool = new SearchModel;
        $m_song = new SongModel;
        $song_arr = $tool->sea($title);
        $id = $song_arr[0]['id'];

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
            'lyric'  => '',
            'mp3'    => $song->mp3Url
        );
        $m_song->id   = $music['id'];
        $m_song->title  = $music['title'];
        $m_song->artist = $music['artist'];
        $m_song->album  = $music['album'];
        $m_song->cover  = $music['cover'];
        $m_song->lyric  = $music['lyric'];
        $m_song->mp3    = $music['mp3'];
        $m_song->type   = $type;

        if($m_song->save()){
            return $this->_return(200,'ok',$music);
        }

    }
}