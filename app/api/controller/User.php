<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\controller\ApiController;
use think\Request;
use app\admin\model\User as UserModel;
use app\common\library\Wx;

class User extends ApiController
{
    protected function initialize():void
    {
        parent::initialize(); // TODO: Change the autogenerated stub

        $this->model = UserModel::class;
    }

    public function login($code, $userInfo = [])
    {
        $data = (new Wx)->login($code);
        $res = (new UserModel())->getUserInfo($data['openid'], $userInfo);
        $this->returnData['data'] = $res;
        $this->returnData['code'] = 1;
        $this->returnApiData();
    }

    public function getUserPhoneNumber($code, $openid)
    {
        $data = (new Wx)->getUserPhoneNumber($code);
        $this->returnData['code'] = $data['errcode'];
        if ($data['errcode'] === 0) {
            (new UserModel())->updatePhone($openid, $data['phone_info']);
            $this->returnData['code'] = 1;
            $this->returnData['data'] = $data['phone_info'];
        }
        $this->returnData['msg'] = $data['errmsg'];
        $this->returnApiData();
    }

    public function signUp($openId, $userInfo) {

    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
