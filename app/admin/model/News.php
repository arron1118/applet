<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class News extends TimeModel
{

    protected $name = "news";

    protected $deleteTime = "delete_time";


    public function newsCate()
    {
        return $this->belongsTo('\app\admin\model\NewsCate', 'cate_id', 'id')->bind(['cate_title' => 'title']);
    }

    public function systemAdmin()
    {
        return $this->belongsTo('\app\admin\model\SystemAdmin', 'author_id', 'id')->bind(['author' => 'username']);
    }

    public function newsComments()
    {
        return $this->hasMany(NewsComments::class, 'id', 'news_id');
    }


    public function getNewsCateList()
    {
        return \app\admin\model\NewsCate::column('title', 'id');
    }
    public function getSystemAdminList()
    {
        return \app\admin\model\SystemAdmin::column('username', 'id');
    }
    public function getStatusList()
    {
        return ['0'=>'禁用','1'=>'启用',];
    }


}
