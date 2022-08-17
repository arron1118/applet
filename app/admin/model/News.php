<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class News extends TimeModel
{

    protected $name = "news";

    protected $deleteTime = "delete_time";


    public function newsCate()
    {
        return $this->belongsTo(NewsCate::class, 'cate_id', 'id')->bind(['cate_title' => 'title']);
    }

    public function systemAdmin()
    {
        return $this->belongsTo(SystemAdmin::class, 'author_id', 'id')->bind(['author' => 'username']);
    }

    public function newsComments()
    {
        return $this->hasMany(NewsComments::class);
    }

    public function userNewsShare() {
        return $this->hasMany(UserNewsShare::class);
    }

    public function userNewsSupport() {
        return $this->hasMany(UserNewsSupport::class);
    }

    public function userNewsCollect() {
        return $this->hasMany(UserNewsCollect::class);
    }

    public function getNewsCateList()
    {
        return NewsCate::column('title', 'id');
    }
    public function getSystemAdminList()
    {
        return SystemAdmin::column('username', 'id');
    }
    public function getStatusList()
    {
        return ['0'=>'禁用','1'=>'启用',];
    }


}
