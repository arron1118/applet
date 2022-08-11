<?php

namespace app\admin\controller\news;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;

/**
 * @ControllerAnnotation(title="新闻分类管理")
 */
class Cate extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->model = new \app\admin\model\NewsCate();

        $this->assign('getStatusList', $this->model->getStatusList());

    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function add($id = null)
    {
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [
                'pid|上级菜单'   => 'require',
                'title|菜单名称' => 'require',
            ];
            $this->validate($post, $rule);
            if ($this->model->save($post)) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败1');
            }
        }
        $this->assign([
            'pidMenuList' => $this->model->getPidMenuList(),
            'id' => $id
        ]);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="编辑")
     */
    public function edit($id)
    {
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [
                'pid|上级菜单'   => 'require',
                'title|菜单名称' => 'require',
            ];
            $this->validate($post, $rule);

            $row->save($post) ? $this->success('保存成功') : $this->error('保存失败');
        }
        $this->assign([
            'id'          => $id,
            'pidMenuList' => $this->model->getPidMenuList(),
            'row'         => $row,
        ]);
        return $this->fetch();
    }

}
