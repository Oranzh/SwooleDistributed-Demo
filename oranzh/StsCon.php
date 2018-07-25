<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/7/24
 * Time: 9:57
 */

namespace oranzh;

require_once '/home/fis/aliyun-openapi-php-sdk/aliyun-php-sdk-core/Config.php';
use Sts\Request\V20150401 as Sts;
define("REGION_ID", "cn-beijing");
define("ENDPOINT", "sts.cn-beijing.aliyuncs.com");

class StsCon
{
    private $roleArn = "acs:ram::1066731078576774:role/app";
    private $client;
    public function __construct()
    {
        DefaultProfile::addEndpoint(REGION_ID, REGION_ID, "StsCon", ENDPOINT);
        $iClientProfile = DefaultProfile::getProfile(REGION_ID, "LTAIC6BLyPGyDeJn", "HX8L7PZX5UDncuFDQEbcqBuMEXCWF8");
        $this->client = new DefaultAcsClient($iClientProfile);
// 角色资源描述符，在RAM的控制台的资源详情页上可以获取
    }

    public function getSts()
    {
        $request = new Sts\AssumeRoleRequest();
// RoleSessionName即临时身份的会话名称，用于区分不同的临时身份
// 您可以使用您的客户的ID作为会话名称
        $request->setRoleSessionName("app_test");
        $request->setRoleArn($this->roleArn);
//$request->setPolicy($policy);
        $request->setDurationSeconds(3600);
        return $this->client->getAcsResponse($request);
    }
}