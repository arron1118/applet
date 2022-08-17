<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class UserSessions extends TimeModel
{

    protected $name = "user_sessions";

    protected $deleteTime = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



}
