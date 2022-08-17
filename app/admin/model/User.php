<?php

namespace app\admin\model;

use app\common\model\TimeModel;

class User extends TimeModel
{

    protected $name = "user";

    protected $deleteTime = "delete_time";



    public function getGenderList()
    {
        return ['0'=>'保密','1'=>'男','2'=>'女',];
    }

    public function getStatusList()
    {
        return ['0'=>'禁用','1'=>'启用',];
    }

    public function signUp($openId, $userInfo)
    {
        $this->openId = $openId;
        
    }
}
