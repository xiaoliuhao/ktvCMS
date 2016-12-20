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
    public function add($name = '', $type = ''){
        $db = new SingerModel;
        //生成拼音
        $name_info = to_en($name);
        //生成拼音缩写
        $db->name           = $name_info['name'];
        $db->short_name    = $name_info['short_name'];
        $db->pinyin         = $name_info['pinyin'];
        $db->is_right       = $name_info['is_right'];
        $db->type          = $type;
        if($db->save()) {
//            return array('status' => 200, 'message' => 'ok', 'data' => '');
            return $this->_return(200, 'ok', $name_info);
        }
    }

    public function getlist($type = '') {
        $db = new SingerModel;
        if($type){
            $sings = $db->field('name,short_name,pinyin,type')->where(array('type'=>$type))->find();
        }else{
            $sings = $db->field('name,short_name,pinyin,type')->select();
        }
        return $this->_return(200, 'ok', $sings);
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