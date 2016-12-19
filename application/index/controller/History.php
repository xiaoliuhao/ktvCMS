<?php
/**
 * *******************************
 * ktv
 * Author: Liu
 * Date: 2016/12/19 16:54
 * Version: 1.0
 *********************************
 */
namespace app\index\controller;
use app\index\model\HistoryModel;

class History extends Base{

    public function index(){
        return "History Controller";
    }

    public function get(){
        $history = new HistoryModel;
        return $history->field('title,artist,album,cover,lyric,mp3,ogg,time')->select();
    }

    public function tuijian(){
        $history = new HistoryModel;
        $data = $history->field('title,artist,album,cover,lyric,mp3,ogg,count(title) as history')->order('history','desc')->group('title')->select();
        return $data;
    }
}