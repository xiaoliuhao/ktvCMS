<?php
/**
 * Created by PhpStorm.
 * User: Liu
 * Date: 2016/11/12
 * Time: 22:11
 */
namespace app\index\controller;

use app\index\model\SongModel;

class Song extends Base{
    public function _initialize() {
        
    }

    public function index() {
        return "SongController";
    }

    public function add($title = '童真', $album = '心灵鸡汤', $author = 'Selina',$mp3 = '') {
        $db = new SongModel;
        $title_info = to_en($title);

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
}