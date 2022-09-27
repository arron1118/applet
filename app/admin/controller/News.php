<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;
use \app\admin\model\NewsCate;

/**
 * @ControllerAnnotation(title="新闻管理")
 */
class News extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->model = new \app\admin\model\News();

        $this->assign('getNewsCateList', $this->model->getNewsCateList());

        $this->assign('getSystemAdminList', $this->model->getSystemAdminList());

        $this->assign('getStatusList', $this->model->getStatusList());

    }


    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            if (input('selectFields')) {
                return $this->selectList();
            }
            list($page, $limit, $where) = $this->buildTableParames();
            $adminId = session('admin.id');
            if ($adminId !== 1) {
                $where[] = ['author_id', '=', $adminId];
            }
            $count = $this->model
                ->with(['systemAdmin', 'newsCate'])
                ->where($where)
                ->count();
            $list = $this->model->withCount(['user'])
                ->with(['systemAdmin', 'newsCate'])
                ->hidden(['systemAdmin', 'newsCate'])
                ->where($where)
                ->page($page, $limit)
                ->order($this->sort)
                ->select();
            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => $count,
                'data'  => $list,
            ];
            return json($data);
        }
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [];
            $this->validate($post, $rule);
            $post['author_id'] = session('admin.id');
            $this->model->save($post) ? $this->success('保存成功') : $this->error('保存失败');
        }
        return $this->fetch();
    }

    public function getNewsCateList()
    {
        return json([
            'code' => 1,
            'data' => $this->model->getNewsCateList(),
            'msg' => '成功'
        ]);
    }
}
