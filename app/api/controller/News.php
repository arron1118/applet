<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\controller\ApiController;
use think\Request;
use app\admin\model\News as NewsModel;

class News extends ApiController
{

    /**
     * 模型
     * @var null
     */
    protected $model = null;

    public function initialize():void
    {
        parent::initialize(); // TODO: Change the autogenerated stub

        $this->model = NewsModel::class;
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($cid)
    {
        $this->returnData['code'] = 1;
        $this->returnData['data'] = $this->model::where([
            ['status', '=', 1],
            ['cate_id', '=', $cid],
        ])->select();
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
