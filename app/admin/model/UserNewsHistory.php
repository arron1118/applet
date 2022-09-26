<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class UserNewsHistory extends TimeModel
{

    protected $name = "user_news_history";

    protected $deleteTime = "delete_time";

    public function getViewTimeAttr($value)
    {
        $minute = 0;
        $second = 0;
        $microtime = 0;

        if ($value > 0) {
            $time = explode('.', $value / 1000);
            $minute = floor($time[0] / 60);
            $second = $time[0] % 60;
            $microtime = $time[1] ?? '000';
        }

        if ($minute < 10) {
            $minute = '0' . $minute;
        }
        if ($second < 10) {
            $second = '0' . $second;
        }

        return $minute . ':' . $second . '.' . $microtime;
    }

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id')->bind(['title']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->bind(['nickname']);
    }



}
