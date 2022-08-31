<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class User extends TimeModel
{

    protected $name = "user";

    protected $deleteTime = "delete_time";



    public function getGenderList()
    {
        return ['0'=>'保密','1'=>'男','2'=>'女'];
    }

    public function getStatusList()
    {
        return ['0'=>'禁用','1'=>'启用'];
    }

    public function getUserInfo($openid, $userInfo) {
        $user = $this->where('openid', $openid)->hidden(['password'])->find();
        if (!$user) {
            $data['openid'] = $openid;
            $data['city'] = $userInfo['city'];
            $data['header_img'] = $userInfo['avatarUrl'];
            $data['country'] = $userInfo['country'];
            $data['province'] = $userInfo['province'];
            $data['nickname'] = $userInfo['nickName'];
            $data['from_news'] = $userInfo['news_id'] ?? 0;
            $this->save($data);

            $user = $this;
        }

        return $user;
    }

    public function updatePhone($openid, $phone_info)
    {
        return $this->where(['openid' => $openid])->save(['phone' => $phone_info['phoneNumber']]);
    }

    public function signUp($openId, $userInfo)
    {
        $this->openId = $openId;

    }

    public function userNewsShare()
    {
        return $this->hasMany(UserNewsShare::class);
    }

    public function userNewsSupport()
    {
        return $this->hasMany(UserNewsSupport::class);
    }

    public function userNewsCollect()
    {
        return $this->hasMany(UserNewsCollect::class);
    }

    public function userNewsHistory()
    {
        return $this->hasMany(UserNewsHistory::class);
    }

    public function userNewsCommentsSupport()
    {
        return $this->hasMany(UserNewsCommentsSupport::class);
    }

    public function fromNews() {
        return $this->belongsTo(News::class, 'from_news', 'id')->bind(['news_title' => 'title']);
    }
}
