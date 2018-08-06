<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午4:49
 */
$config['mysql']['enable'] = true;
$config['mysql']['active'] = 'wss';
$config['mysql']['test']['host'] = '127.0.0.1';
$config['mysql']['test']['port'] = '3306';
$config['mysql']['test']['user'] = 'sd';
$config['mysql']['test']['password'] = 'sd...';
$config['mysql']['test']['database'] = 'sd';
$config['mysql']['test']['charset'] = 'utf8';


$config['mysql']['wss']['host'] = '127.0.0.1';
$config['mysql']['wss']['port'] = '3306';
$config['mysql']['wss']['user'] = 'wss';
$config['mysql']['wss']['password'] = 'wss...';
$config['mysql']['wss']['database'] = 'wss';
$config['mysql']['wss']['charset'] = 'utf8';

$config['mysql']['asyn_max_count'] = 10;

return $config;