<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class UserSessions extends TimeModel
{

    protected $name = "user_sessions";

    protected $deleteTime = false;

    
    public function user()
    {
        return $this->belongsTo('\app\admin\model\User', 'user_id', 'id');
    }

    

}