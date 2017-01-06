<?php
/**
 * ------ktv------
 * Author: Liu
 * Date: 2016/11/15 16:02
 * Version: 1.0
 */

namespace app\index\Model;
use think\Model;
class OldPlaylistModel extends Model{
    protected $table = 'ktv_room_playlist';
    protected $createTime = 'time';
    protected $autoWriteTimestamp = 'datetime';
    protected $insert = ['rank'=>'0'];
    protected $type = [
        'rank' => 'integer',
    ];
}