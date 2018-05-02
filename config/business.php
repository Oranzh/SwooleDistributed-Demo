<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-14
 * Time: 下午1:58
 */

//强制关闭gzip
$config['http']['gzip_off'] = false;

//默认访问的页面
$config['http']['index'] = 'index.html';

/**
 * 设置域名和Root之间的映射关系
 */

$config['http']['root'] = [
    'default' =>
        [
            'render' => "server::welcome" //转到模板
        ],

    '高明霞.我爱你' =>
        [
            'render' => "app::wiki/page/user/detail/main" //转到模板
        ],
    'oranzh.cc' =>
        [
            'root' => 'www',
            'index' => 'index.html'
        ],
    '60.205.184.253' =>
        [
            'render' => "app::app/oranzh"
//            'root' => 'localhost',
//            'index' => 'Index.html'
        ]

];

return $config;
