<?php
/**
 * Created by PhpStorm.
 * User: lihang
 * Date: 19-1-7
 * Time: 下午11:08
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use think\Request;

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
        $request = Request::instance();
        $catid = $request->param('catid',0);

        //获取数据模型
        $goods_model = model('Goods');
        $category_model = model('Category');

        //获取分类
        $category_orms = $category_model
            ->field('id,name')
            ->where('type','goods')
            ->select();

        $map['is_show'] = 1;
        if($catid){
            $map['cat_id'] = $catid;
        }
        //查询列表
        $goods_orms = $goods_model
            ->where($map)
            ->order('sort desc,id desc')
            ->paginate(20);
        //分页
        $page = $goods_orms->render();
        //模板赋值
        $this->assign('catid',$catid);
        $this->assign('cat_list',$category_orms);
        $this->assign('list',$goods_orms);
        $this->assign('page',$page);
        return $this->view->fetch('list');
    }

    public function detail($id){
        //获取数据模型
        $goods_model = model('Goods');
        $goods_desc_model = model('GoodsDesc');
        //查询记录
        $goods_orm = $goods_model
            ->where('id',$id)
            ->where('is_show',1)
            ->find();

        if($goods_orm){
            //查询记录详情
            $goods_orm['content'] = '';
            $goods_content = $goods_desc_model->where('goods_id',$goods_orm['id'])->find();
            if($goods_content){
                $goods_orm['content'] = $goods_content['content'];
            }
        }

        $this->assign('left_list', $this->get_pub_left());
        $this->assign('goods',$goods_orm);
        return $this->view->fetch();
    }
}