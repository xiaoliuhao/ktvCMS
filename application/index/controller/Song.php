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

    public function add() {

    }

    public function show($id = '', $name = '') {
        
    }

    public function test() {
        $song = SongModel::get('S00001');
        $song->get('S00001');
        return $song;
    }
}