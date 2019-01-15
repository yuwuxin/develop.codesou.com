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

    /**
     * @return string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {

        //1F通用
        $goods_list = $this->getGoodsList(83);
        $goods_list2 = $this->getGoodsList(54);
        $goods_list3 = $this->getGoodsList(87);
        $goods_list4 = $this->getGoodsList(88);

        //推荐文章
        $article_model = model('Article');
        $article_list = $article_model->field('id,title')->where('cat_id', 16)->limit(8)->select()->toArray();
        $article_list2 = $article_model->field('id,title')->where('cat_id', 17)->limit(8)->select()->toArray();
        $article_list3 = $article_model->field('id,title')->where('cat_id', 21)->limit(8)->select()->toArray();
        $article_list4 = $article_model->field('id,title')->where('cat_id', 22)->limit(8)->select()->toArray();

        //友情链接
        $link_model = model('Link');
        $link_list = $link_model->field('title,url')->where('is_show', 1)->select();

        //商品赋值
        $this->assign('goods_list', $goods_list);
        $this->assign('goods_list2', $goods_list2);
        $this->assign('goods_list3', $goods_list3);
        $this->assign('goods_list4', $goods_list4);
        //文章赋值
        $this->assign('article_list', $article_list);
        $this->assign('article_list1', $article_list2);
        $this->assign('article_list2', $article_list3);
        $this->assign('article_list3', $article_list4);
        //友链赋值
        $this->assign('link_list', $link_list);

        return $this->view->fetch();
    }

    /**
     * @return \think\response\Jsonp
     */
    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }

    /**
     * 获取商品列表
     * @param $cat_id
     * @param int $page_size
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getGoodsList($cat_id, $page_size = 15)
    {
        //默认结果
        $data = [];
        //获取模型
        $goods_model = model('Goods');
        //查询结果
        $goods_orms = $goods_model->field('id,goods_name,goods_sn,cat_id,brand_id,cover_img,click_count,created_at')
            ->where('cat_id', $cat_id)
            ->where('is_show', 1)
            ->limit($page_size)
            ->select()
            ->toArray();
        if ($goods_orms) {
            $data = $goods_orms;
        }
        //返回结果
        return $data;
    }
}
