<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\controller\ApiController;
use think\Request;
use app\admin\model\NewsComments as NewsCommentsModel;

class NewsComments extends ApiController
{
    protected $model = null;

    public function initialize():void
    {
        parent::initialize(); // TODO: Change the autogenerated stub

        $this->model = NewsCommentsModel::class;
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $page = $this->params['page'] ?? 1;
        $limit = $this->params['limit'] ?? 10;
        $this->returnData['code'] = 1;
        $this->returnData['data'] = $this->model::where([
            ['news_id', '=', $this->params['news_id']]
        ])
            ->limit(($page - 1) * $limit, $limit)
            ->select();
        $this->returnApiData();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $this->returnData['code'] = 1;
        $this->returnData['data'] = $this->model::save([
            'pid' => $this->params['pid'] ?? 0,
            'news_id' => $this->params['news_id'],
            'user_id' => $this->userInfo->id,
            'content' => $this->params['content'],
        ]);
        $this->returnApiData();
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
