<?php
/**
 * Created by PhpStorm.
 * User: lihang
 * Date: 19-1-7
 * Time: 下午10:43
 */

namespace app\index\controller;

use app\common\controller\Frontend;

class Article extends Frontend
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

        $page = input('get.page',1);
        $start = ($page-1)*20;
        $model = model('Article');
        $list = $model->limit($start,10)->order('id desc')->select();
        $this->assign('list',$list);
        return $this->view->fetch();
    }

    public function detail(){
        return $this->view->fetch();
    }
}