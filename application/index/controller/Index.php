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

        //推荐文章
        $article_model = model('article');
        $article_list = $article_model->field('id,title')->where('cat_id',16)->limit(8)->select()->toArray();
        $article_list2 = $article_model->field('id,title')->where('cat_id',17)->limit(8)->select()->toArray();
        $article_list3 = $article_model->field('id,title')->where('cat_id',21)->limit(8)->select()->toArray();
        $article_list4 = $article_model->field('id,title')->where('cat_id',22)->limit(8)->select()->toArray();

        //友情链接
        $link_model = model('link');
        $link_list = $link_model->field('title,url')->where('is_show',1)->select();

        $this->assign('article_list', $article_list);
        $this->assign('article_list1', $article_list2);
        $this->assign('article_list2', $article_list3);
        $this->assign('article_list3', $article_list4);
        $this->assign('link_list', $link_list);

        return $this->view->fetch();
    }

    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }

}
