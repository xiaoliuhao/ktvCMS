<?php
/**
 * *********ktv*******
 * Author: Liu               *
 * Date: 2016/11/15 20:13         *
 * Version: 1.0                  *
 *********************************
 */

namespace app\index\controller;
use app\index\model\SingerModel;

class Singer extends Base{
    public function _initialize(){

    }
    public function index(){
        return "SingerController";
    }
    public function add(){

        return array('status'=>200, 'message'=>'ok', 'data'=>'');
    }

    public function delete(){

        return array('status'=>200, 'message'=>'ok', 'data'=>'');
    }

    public function update(){

        return array('status'=>200, 'message'=>'ok', 'data'=>'');
    }

    public function search(){

        return array('status'=>200, 'message'=>'ok', 'data'=>'');
    }

}