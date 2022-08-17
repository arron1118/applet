<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class UserNewsCommentsSupport extends TimeModel
{

    protected $name = "user_news_comments_support";

    protected $deleteTime = "delete_time";


    public function newsComments()
    {
        return $this->belongsTo(NewsComments::class, 'comments_id', 'id')->bind(['content']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->bind(['nickname']);
    }



}
