<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::pattern([
    'id' => '\d+',
    'name' => '\w+',
]);

/*Route::rule('index','index/index');*/

Route::rule('article','index/article/index');
Route::rule('article-<id>','index/article/detail');
Route::rule('list-<id>','index/category/articleList');
Route::rule('goods','index/goods/index');
Route::rule('goods-<id>','index/goods/detail');
