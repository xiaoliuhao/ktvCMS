<?php
namespace app\index\controller;

use app\index\model\User;

class Index extends Base{
    public function index() {
//        $this->display('index');
        return view('index.html');
    }

    public function say() {
    	return ['data'=>'hello'];
    }

    public function test() {
        $user = new User;

//        echo $user->name;
        $data = $user->limit(10)->order('t_id','desc')->select();

        foreach($data as $key=>$value){
            $data_arr = $value->photo;
            var_dump($value);
        }
//        return $data;
    }

    public function time(){
        $today = date('Y-m-d');
        $day = 12;
        $tomorr = date('Y-m-d',strtotime("+{$day} day",strtotime($today)));
        return array('status'=>200, 'message'=>'ok', 'data'=>$tomorr);
    }

}
