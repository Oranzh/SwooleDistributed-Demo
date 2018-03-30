<?php
/**
 * 接收静态文件,并发布到OSS上去
 *
 * @author hufeng(@yunbix.com)
 */

@error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include '/home/work/pdp/phplib/arch/oss/autoload.php';	//依赖阿里云的SDK
use OSS\OssClient; 
use OSS\Model\CorsConfig;
use OSS\Model\CorsRule;
use OSS\Core\OssException;

$ai = "mpiKOScEPFCGAAJ1";
$ak = "bRsB3MS7yl2wLpZXBxJbGztg0jHv45";
$hostname = "oss-cn-beijing-internal.aliyuncs.com";	//北京使用
$bucket = 'gmx';
$s3 = new OssClient($ai, $ak, $hostname,false);
$corsConfig = new CorsConfig();
$rule = new CorsRule();
$rule->addAllowedHeader("x-oss-header");
$rule->addAllowedOrigin("*");
$rule->addAllowedMethod("GET");
$rule->setMaxAgeSeconds(10);
$corsConfig->addRule($rule);
$s3->putBucketCors($bucket, $corsConfig);

if($_POST['to']){
    $to = trim($_POST['to'], '/');
    if($_FILES["file"]["error"] > 0){
        header("Status: 500 Internal Server Error");
    } else {
		$res = $s3->uploadFile($bucket, $to, $_FILES['file']['tmp_name']);

		if(200 == $res->header['_info']['http_code']){
			echo '0';
		}else{
			echo '1';
		}
	}
} else {
    echo 'I\'m ready for that, you know.';
}

