<?php
/**
 * Created by PhpStorm.
 * User: lihang
 * Date: 19-1-9
 * Time: 上午12:25
 */

namespace app\index\controller;


use app\common\controller\Frontend;

class Category extends Frontend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        return $this->view->fetch();
    }

    public function info($id)
    {
        $model = model('Article');
        $cat_model = model('Category');

        $cat_orm = $cat_model->field('id,name,nickname,type,flag')
            ->where('id', $id)
            ->find()
            ->toArray();
        $art_orms = $model->field('id,title,created_at')
            ->where('cat_id', $id)
            ->paginate(10);

        // 获取分页显示
        $page = $art_orms->render();

        $this->assign('page', $page);
        $this->assign('cat', $cat_orm);
        $this->assign('list', $art_orms);
        $this->assign('left_list', $this->get_pub_left());
        return $this->view->fetch();
    }
}