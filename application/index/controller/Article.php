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

    public function index()
    {
        $cat_model = model('Category');
        $article_model = model('Article');
        $cat_list = $cat_model->field('id,name,flag,type,nickname')
            ->where('is_show',1)
            ->where('type','article')
            ->select()
            ->toArray();
        $data = [];
        if($cat_list){
            foreach ($cat_list as $k => $v){
                $article_list =$article_model
                    ->field('id,title,cat_id,created_at')
                    ->where('cat_id',$v['id'])
                    ->where('is_show',1)
                    ->order('id desc')
                    ->limit(10)
                    ->select()
                    ->toArray();
                if($article_list){
                    $data[$k]['cat'] = $v;
                    $data[$k]['list'] = $article_list;
                }
            }
        }

        $this->assign('cat_list', $data);
        return $this->view->fetch();
    }

    public function detail($id)
    {
        $model = model('Article');
        $article = $model->where('id', $id)->find()->toArray();

        $this->assign('article', $article);
        return $this->view->fetch();
    }
}