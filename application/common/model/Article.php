<?php
/**
 * Created by PhpStorm.
 * User: lihang
 * Date: 19-1-8
 * Time: 下午5:25
 */
namespace app\common\model;

use think\model;

class Article extends model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
}