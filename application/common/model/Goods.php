<?php
/**
 * Created by PhpStorm.
 * User: lihang
 * Date: 19-1-14
 * Time: 下午4:28
 */

namespace app\common\model;


use think\Model;

class Goods extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'created_at';
}