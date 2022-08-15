<?php

namespace app\common\library;

use app\admin\model\SystemConfig;
use Curl\Curl;

class Wx
{
    private array $config = [
        'appId' => '',
        'appSecret' => '',
    ];

    public function __construct()
    {
        $this->config['appId'] = SystemConfig::where('name', 'miniapp_appid')->value('value');
        $this->config['appSecret'] = SystemConfig::where('name', 'miniapp_appsecret')->value('value');
    }

    public function getAccessToken()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token';
        if (!session('?wx_access_token') || session('wx_access_token.expires_in') < time()) {
            $res = $this->send($url);
            $res['expires_in'] = time() + $res['expires_in'];
            session('wx_access_token', $res);
        }

        return session('wx_access_token');
    }

    /**
     * @throws \JsonException
     */
    protected function send($url, $method = 'get', $param = [])
    {
        $param = array_merge([
            'grant_type' => 'client_credential',
            'appid' => $this->config['appId'],
            'secret' => $this->config['appSecret']
        ], $param);
        $curl = new Curl();
        $method === 'get' ? $curl->get($url, $param) : $curl->post($url, $param);
        return json_decode($curl->response, true);
    }
}
