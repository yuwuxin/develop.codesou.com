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

    public function index(){
        return $this->view->fetch();
    }

    public function info(){
        $model = model('Article');
        $article = $model->where('id', 1)->find()->toArray();

        $this->assign('article', $article);
        return $this->view->fetch();
    }
}