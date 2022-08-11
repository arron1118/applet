<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class NewsComments extends TimeModel
{

    protected $name = "news_comments";

    protected $deleteTime = "delete_time";


    public function news()
    {
        return $this->belongsTo('\app\admin\model\News', 'news_id', 'id')->bind(['title']);
    }

    public function user()
    {
        return $this->belongsTo('\app\admin\model\User', 'user_id', 'id')->bind(['nickname']);
    }



}
