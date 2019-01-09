<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {

        $article_model = model('article');
        $article_orm = $article_model->table('cs_article')
            ->field('a.id,a.title,a.cat_id')
            ->alias('a')
            ->join('cs_article b', 'a.cat_id = b.cat_id AND a.id < b.id', 'LEFT')
            ->where('a.is_show',1)
            ->group('a.id,a.cat_id')
            ->order('a.id desc')
            ->having('count(b.id) < 8')
            //->fetchSql(true)
            ->select()
            ->toArray();
        $article_list = [];
        if($article_orm){
            $cat_ids = array_column($article_orm,'cat_id');
        }

        $this->assign('article_list', $article_orm);
        return $this->view->fetch();
    }

    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }

}
