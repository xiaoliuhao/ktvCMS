<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    //路由设置为默认是index模块
    '__alias__'=>[
        'playlist' => 'index/Playlist',
        'user'     => 'index/User',
        'song'     => 'index/Song',
        'room'     => 'index/Room',
        'search'   => 'index/Search',
    ],
//    'playlist/[:name]$'=>'index/playlist'
//    'say/[:name]' => 'index/say',
//    'user/login' => 'index/user/login',
//    'user/index/[:name]'=> 'index/user/index',
//    'Song/test' => 'index/Song/test',
//    'Playlist/index'=>'index/Playlist/index',
//    'Playlist/add'=>'index/Playlist/add',
//    'playlist/' => 'index/playlist/'
];
