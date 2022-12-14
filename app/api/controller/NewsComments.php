<?php
declare (strict_types=1);

namespace app\api\controller;

use app\common\controller\ApiController;
use think\Request;
use app\admin\model\NewsComments as NewsCommentsModel;

class NewsComments extends ApiController
{
    protected $model = null;

    public function initialize(): void
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
        $comments = $this->model::field('id, pid, user_id, content, support, create_time')
            ->withJoin(['user' => function ($query) {
                $query->withField('header_img, nickname');
            }])
            ->where('news_id', $this->params['news_id'])
            ->order('id', 'asc')
            ->select();
        $this->returnData['data'] = $this->commentsFilter($comments);
        $this->returnApiData();
    }

    protected function commentsFilter($comments, $pid = 0)
    {
        $temp = [];
        foreach ($comments as $key => $val) {
            if ($val['pid'] === $pid) {
                unset($comments[$key]);
                if (!empty($comments)) {
                    $val['child'] = $this->commentsFilter($comments, $val['id']);
                }
                $temp[] = $val;
            }
        }

        return $temp;
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $this->returnData['code'] = 1;
        $this->returnData['data'] = (new $this->model)->save([
            'pid' => $this->params['pid'] ?? 0,
            'news_id' => $this->params['news_id'],
            'user_id' => $this->userInfo->id,
            'content' => $this->params['content'],
        ]);
        $this->returnApiData();
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
        $params = $request->only(['id', 'support']);

        $model = new \app\admin\model\userNewsCommentsSupport();
        $res = $model->where(['comments_id' => $id, 'user_id' => $this->userInfo->id])->find();
        if (!$res) {
            $this->model::where('id', $id)->inc('support')->update();
            $model->save(['comments_id' => $id, 'user_id' => $this->userInfo->id]);
        } else {
            $this->model::where('id', $id)->dec('support')->update();
            $res->delete();
        }

        $this->returnData['code'] = 1;
        $this->returnApiData();
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
