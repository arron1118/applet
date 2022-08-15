<?php

namespace app\common\library;

use app\admin\model\SystemConfig;
use Curl\Curl;

class Wx
{
    private array $errCode = [
        -1 => '系统繁忙',
        0 => '请求成功',
        40001 => '获取 access_token 时 AppSecret 错误，或者 access_token 无效',
        40013 => '不合法的 AppID',
        40029 => 'code无效',
        40226 => '高风险等级用户，小程序登录拦截',
        45011 => 'API调用太频繁，请稍候再试',
    ];

    private array $config = [
        'appId' => '',
        'appSecret' => '',
    ];

    public function __construct()
    {
        $this->config['appId'] = SystemConfig::where('name', 'miniapp_appid')->value('value');
        $this->config['appSecret'] = SystemConfig::where('name', 'miniapp_appsecret')->value('value');
    }

    /**
     * @return mixed
     * @throws \JsonException
     * {
            "access_token":"ACCESS_TOKEN",
            "expires_in":7200
        }
     */
    public function getAccessToken()
    {
        if (!session('?wx_access_token') || session('wx_access_token.expires_in') < time()) {
            $url = 'https://api.weixin.qq.com/cgi-bin/token';
            $res = $this->send($url, 'get', [
                'grant_type' => 'client_credential',
                'appid' => $this->config['appId'],
                'secret' => $this->config['appSecret']
            ]);
            $res['expires_in'] = time() + $res['expires_in'];
            session('wx_access_token', $res);
        }

        return session('wx_access_token');
    }

    /**
     * @param $code
     * @throws \JsonException
     * {
            "openid":"xxxxxx",
            "session_key":"xxxxx",
            "unionid":"xxxxx",
            "errcode":0,
            "errmsg":"xxxxx"
        }
     */
    public function login($code)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        return $this->send($url, 'get', [
            'grant_type' => 'authorization_code',
            'js_code' => $code,
            'appid' => $this->config['appId'],
            'secret' => $this->config['appSecret']
        ]);
    }

    /**
     * @param $code
     * @return mixed
     * @throws \JsonException
     * {
            "errcode":0,
            "errmsg":"ok",
            "phone_info": {
                "phoneNumber":"xxxxxx",
                "purePhoneNumber": "xxxxxx",
                "countryCode": 86,
                "watermark": {
                    "timestamp": 1637744274,
                    "appid": "xxxx"
                }
            }
        }
     */
    public function getUserPhoneNumber ($code) {
        $url = 'https://api.weixin.qq.com/wxa/business/getuserphonenumber';
        return $this->send($url, 'get', [
            'access_token' => $this->getAccessToken()['access_token'],
            'code' => $code
        ]);
    }

    /**
     * @throws \JsonException
     */
    protected function send($url, $method = 'get', $param = [])
    {
        $curl = new Curl();
        $method === 'get' ? $curl->get($url, $param) : $curl->post($url, $param);
        return json_decode($curl->response, true);
    }

    /**
     * @param int $code
     * @return mixed|string
     */
    public function getErrMesaage($code = 0) {
        return $this->errCode[$code];
    }
}
