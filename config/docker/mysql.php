<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午4:49
 */
$config['mysql']['enable'] = true;
$config['mysql']['active'] = 'rds';
$config['mysql']['rds']['host'] = 'rm-uf6m73ix64u02bm6po.mysql.rds.aliyuncs.com';
$config['mysql']['rds']['port'] = '3306';
$config['mysql']['rds']['user'] = 'root';
$config['mysql']['rds']['password'] = 'Root@147852';
$config['mysql']['rds']['database'] = 'sd';
$config['mysql']['rds']['charset'] = 'utf8';
$config['mysql']['asyn_max_count'] = 10;
// mysql -hrm-uf6m73ix64u02bm6po.mysql.rds.aliyuncs.com -uroot -pRoot@147852
return $config;
