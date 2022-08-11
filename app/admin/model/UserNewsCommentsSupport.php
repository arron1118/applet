<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class UserNewsCommentsSupport extends TimeModel
{

    protected $name = "user_news_comments_support";

    protected $deleteTime = "delete_time";

    
    public function newsComments()
    {
        return $this->belongsTo('\app\admin\model\NewsComments', 'comments_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('\app\admin\model\User', 'user_id', 'id');
    }

    

}