<?php
/**
 * oss上传文件配置
 */


$config['oss']['host'] = 'oss-cn-beijing-internal.aliyuncs.com';
$config['oss']['url'] = 'oss-cn-beijing.aliyuncs.com';
$config['oss']['ak'] = 'mpiKOScEPFCGAAJ1';
$config['oss']['sk'] = 'bRsB3MS7yl2wLpZXBxJbGztg0jHv45';
$config['oss']['bucket'] = 'mahuateng';
$config['oss']['scheme'] = 'https';
$config['oss']['cdn'] = 'mahuateng.oranzh.cc';
$config['oss']['ns'] = 'image';
$config['oss']['path'] = 'sd';
$config['oss']['callback'] = 'https://www.xiaohui.li/oss/callback';

$config['oss']['sts']['REGION_ID'] = 'cn-beijing';
$config['oss']['sts']['ENDPOINT'] = 'sts.cn-beijing.aliyuncs.com';
$config['oss']['sts']['AccessKeyID'] = 'LTAIC6BLyPGyDeJn';
$config['oss']['sts']['AccessKeySecret'] = 'HX8L7PZX5UDncuFDQEbcqBuMEXCWF8';
$config['oss']['sts']['roleArn'] = 'acs:ram::1066731078576774:role/app';
$config['oss']['sts']['RoleName'] = 'client_name';

return $config;
