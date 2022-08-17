<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class UserNewsShare extends TimeModel
{

    protected $name = "user_news_share";

    protected $deleteTime = "delete_time";


    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id')->bind(['title']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->bind(['nickname']);
    }



}
