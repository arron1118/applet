<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class NewsComments extends TimeModel
{

    protected $name = "news_comments";

    protected $deleteTime = "delete_time";


    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id')->bind(['title']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userNewsCommentsSupport()
    {
        return $this->hasMany(UserNewsCommentsSupport::class, 'comments_id', 'id');
    }

}
