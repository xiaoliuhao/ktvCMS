<?php
/**
 * *******************************
 * ktv
 * Author: Liu
 * Date: 2016/12/7 20:12
 * Version: 1.0
 *********************************
 */
namespace app\index\controller;
use app\index\model\SearchModel;
use app\index\model\StatusModel;

class Search extends Base{
    public function _initialize(){}
    public function index(){
        return "SearchController";
    }

    /**
     * 关键字搜索 歌曲或者歌手
     * @param string $key
     * @param int $limit
     * @return array
     */
    public function get($key = '', $page = 1, $limit = 10){
        $is_pinyin = is_pinyin($key);
        if($is_pinyin){
            $result = $this->get_from_mysql($key);
        }else{
            $result = $this->mysearch($key, $page, $limit);
        }
        return $this->_return(200,'ok',$result);
    }

    protected function mysearch($key, $page, $limit){
        $model = new SearchModel;
        $json = $model->search($key, $limit, $page);
        $data = json_decode($json)->result->songs;
        $songs = array();
        foreach ($data as $song){
            $songs[] = $this->search_detail($song->id);
        }
        return $songs;
    }

    /**
     * 歌曲详情
     * @param string $id
     * @return array
     */
    public function music_detail($id = ''){
        $model = new SearchModel;
        $url = "http://music.163.com/api/song/detail/?id=" . $id . "&ids=%5B" . $id . "%5D";
        $json = $model->curl_get($url);
        $data = json_decode($json);
        $song = $data->songs[0];
        $music = array(
            'id'    => $song->id,
            'name'  => $song->name,
            'playtime'  => date('i:s', substr($song->duration, 0, 3)),
            'url'   => $song->mp3Url,
            'lyric' => $this->get_lyric($id),
            'pic'   => $song->album->picUrl,
            'album' => array(
                'id'=>$song->album->id,
                'name'=>$song->album->name,
            )
        );
        return $music;
    }

    //获取歌手的专辑列表
    public function get_artist_album($id, $page = 1,$limit = 10){
        $url = "http://music.163.com/api/artist/albums/" . $id . "?limit=" . $limit ."&offset=". $page;
        $data = $this->curl_get($url);
        return $data;
    }

    /**
     * 获取专辑详情
     * @param $id
     * @return \think\response\Json
     */
    public function get_album_info($id){
        $url = "http://music.163.com/api/album/" . $id;
        $data = $this->curl_get($url);
        $album = $data->album;

        $result = array(
            'id'    => $album->id,
            'name'  => $album->name,
            'pic'   => $album->picUrl
        );
        $songs = array();
        foreach ($album->songs as $song){
            $songs[] = array(
                'id'    => $song->id,
                'name'  => $song->name,
                'artists'=> array(
                    'id'    => $song->artists[0]->id,
                    'name'  => $song->artists[0]->name,
                    'pic'   => $song->artists[0]->picUrl
                )
            );
        }
        $result['songs'] = $songs;
        return $this->_return(200,'ok',$result);
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

    public function add($id){

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
    
    public function get_from_mysql($key){
        $model = new SearchModel;
        $data = $model->get_from_list($key);
        $songs = array();
        foreach ($data as $key => $value) {
            $songs[] = $this->search_detail($value['id']);
        }
        return $songs;
    }

    protected function search_detail($id){
        $model = new SearchModel;
        $url = "http://music.163.com/api/song/detail/?id=" . $id . "&ids=%5B" . $id . "%5D";
        $json = $model->curl_get($url);
        $song_detail = json_decode($json)->songs[0];

        $songs = array(
            'id'    => $song_detail->id,
            'name'  => $song_detail->name,
            'playtime'  => date('i:s', substr($song_detail->duration, 0, 3)),
            'artists'=> array(
                'id'=> $song_detail->artists[0]->id,
                'name'=>$song_detail->artists[0]->name,
                'pic'=>$song_detail->artists[0]->img1v1Url
            ),
            'album' => array(
                'id'=>$song_detail->album->id,
                'name'=>$song_detail->album->name,
            )
        );
        return $songs;
    }
}