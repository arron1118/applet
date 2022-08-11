<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class UserNewsCollect extends TimeModel
{

    protected $name = "user_news_collect";

    protected $deleteTime = "delete_time";

    
    public function news()
    {
        return $this->belongsTo('\app\admin\model\News', 'news_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('\app\admin\model\User', 'user_id', 'id');
    }

    

}