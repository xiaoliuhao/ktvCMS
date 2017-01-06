<?php
/**
 * *******************************
 * ktv
 * Author: Liu
 * Date: 2016/12/7 20:24
 * Version: 1.0
 *********************************
 */
namespace app\index\Model;
use think\Model;
class SearchModel extends Model{
    public function search($word = '', $limit = 10, $page){
        $url = "http://music.163.com/api/search/get/web?csrf_token=";
        $curl = curl_init();
        $post_data = 'hlpretag=&hlposttag=&s='. $word . '&type=1&offset='.$page.'&total=true&limit=' . $limit;
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

        $header =array(
            'Host: music.163.com',
            'Origin: http://music.163.com',
            'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36',
            'Content-Type: application/x-www-form-urlencoded',
            'Referer: http://music.163.com/search/',
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $src = curl_exec($curl);
        curl_close($curl);
        return $src;
    }
    
    public function curl_get($url){
        $refer = "http://music.163.com/";
        $header[] = "Cookie: " . "appver=1.5.0.75771;";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, $refer);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * 获取歌词
     * @param $id
     * @return mixed
     */
    public function get_lyric($id){
        $url = "http://ktvcms.xiaohaozi.com.cn/ktv/search/get_lyric?id={$id}";
        $data = json_decode($this->curl_get($url), true);
        return $data;
    }

    public function sea($key = '', $page = 1, $limit = 10){
        $model = new SearchModel;
        $json = $model->search($key, $limit, $page);
        $data = json_decode($json)->result->songs;
        $songs = array();
        foreach ($data as $song){
            $url = "http://music.163.com/api/song/detail/?id=" . $song->id . "&ids=%5B" . $song->id . "%5D";
            $json = $model->curl_get($url);
            $song_detail = json_decode($json)->songs[0];

            $songs[] = array(
                'id'    => $song->id,
                'name'  => $song->name,
                'playtime'  => date('i:s', substr($song_detail->duration, 0, 3)),
                'artists'=> array(
                    'id'=> $song->artists[0]->id,
                    'name'=>$song->artists[0]->name,
                    'pic'=>$song->artists[0]->img1v1Url
                ),
                'album' => array(
                    'id'=>$song->album->id,
                    'name'=>$song->album->name,
                )
            );
        }
        return $songs;
    }
    public function get_from_list($key){
        $sql = "select * from ktv_songs where short_title like '%{$key}%' or pinyin like '%{$key}%' limit 10";
        $data = $this->query($sql);
        return $data;
    }
}