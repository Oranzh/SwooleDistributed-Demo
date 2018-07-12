<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午4:49
 */
$config['mysql']['enable'] = true;
$config['mysql']['active'] = 'test';
$config['mysql']['test']['host'] = '127.0.0.1';
$config['mysql']['test']['port'] = '3306';
$config['mysql']['test']['user'] = 'sd';
$config['mysql']['test']['password'] = 'sd...';
$config['mysql']['test']['database'] = 'sd';
$config['mysql']['test']['charset'] = 'utf8';


$config['mysql']['bus']['host'] = '127.0.0.1';
$config['mysql']['bus']['port'] = '3306';
$config['mysql']['bus']['user'] = 'root';
$config['mysql']['bus']['password'] = '123456';
$config['mysql']['bus']['database'] = 'bus';
$config['mysql']['bus']['charset'] = 'utf8';

$config['mysql']['asyn_max_count'] = 10;

return $config;