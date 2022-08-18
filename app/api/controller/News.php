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
    public function index()
    {
        $cid = $this->params['cid'] ?? 0;
        $page = $this->params['page'] ?? 1;
        $limit = $this->params['limit'] ?? 10;
        $title = $this->params['title'] ?? '';
        $where = [
            ['status', '=', 1],
        ];

        if ($title !== '') {
            $where[] = ['title', 'like', '%' . $title . '%'];
        }

        if ($cid > 0) {
            $where[] = ['cate_id', '=', $cid];
        }

        $this->returnData['code'] = 1;
        $this->returnData['data'] = $this->model::field('id, title, cover_img, create_time, read_count')
            ->where($where)
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
        $this->returnData['code'] = 1;
        $this->returnData['data'] = $this->model::withCount(['news_comments'])->find($id);
        $this->returnApiData();
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
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function setInc(Request $request, $id)
    {
        $params = $request->only(['id', 'share', 'collect', 'support', 'read_count']);
        $model = null;
        foreach ($params as $key => $val) {
            if ($key !== 'id') {
                $this->model::where('id', $id)->inc($key)->update();
            }

            if ($key === 'share') {
                $model = new \app\admin\model\UserNewsShare();
            } elseif ($key === 'collect') {
                $model = new \app\admin\model\UserNewsCollect();
            } elseif ($key === 'support') {
                $model = new \app\admin\model\UserNewsSupport();
            } elseif ($key === 'read_count') {
                $model = new \app\admin\model\UserNewsHistory();
            }
        }

        if ($model !== null) {
            $model->save(['news_id' => $id, 'user_id' => $this->userInfo->id]);
        }

        $this->returnData['code'] = 1;
        $this->returnApiData();
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
