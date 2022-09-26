<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;

/**
 * @ControllerAnnotation(title="用户管理")
 */
class User extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->model = new \app\admin\model\User();

        $this->assign('getGenderList', $this->model->getGenderList());

        $this->assign('getStatusList', $this->model->getStatusList());

    }

    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        $news_id = $this->request->get('from_news', 0);
        $this->assign('from_news', $news_id);
        if ($this->request->isAjax()) {
            if (input('selectFields')) {
                return $this->selectList();
            }
            list($page, $limit, $where) = $this->buildTableParames();
            if ($news_id > 0) {
                $where[] = ['from_news', '=', $news_id];
            }
            $adminId = session('admin.id');
            if ($adminId !== 1) {
                $where[] = ['admin_id', '=', $adminId];
            }

            $count = $this->model
                ->where($where)
                ->count();
            $list = $this->model->with(['fromNews'])
                ->withoutField('password')
                ->where($where)
                ->page($page, $limit)
                ->order('id', 'desc')
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

}
