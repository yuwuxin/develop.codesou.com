<?php
/**
 * Created by PhpStorm.
 * User: lihang
 * Date: 19-1-7
 * Time: 下午11:08
 */

namespace app\index\controller;


use app\common\controller\Frontend;

class Goods extends Frontend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index(){
        return $this->view->fetch('list');
    }

    public function detail(){
        return $this->view->fetch();
    }
}