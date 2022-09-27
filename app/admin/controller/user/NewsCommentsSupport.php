<?php

namespace app\admin\controller\user;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;

/**
 * @ControllerAnnotation(title="评论点赞管理")
 */
class NewsCommentsSupport extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->model = new \app\admin\model\UserNewsCommentsSupport();

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
                $where[] = ['admin_id', '=', $adminId];
            }
            $count = $this->model
                ->with(['user', 'newsComments'])
                ->where($where)
                ->count();
            $list = $this->model
                ->with(['user', 'newsComments'])
                ->hidden(['user', 'newsComments'])
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
}
