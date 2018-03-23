<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/3/23
 * Time: 9:27
 */

namespace app\Tasks\tools;

use OSS\OssClient;
use Server\CoreBase\Task;
use Server\CoreBase\SwooleException;
use Server\CoreBase\HttpInput;

class OssTask extends Task
{
    private $ossClient;
    private $ossConfig;

    public function __construct()
    {
        parent::__construct();
        $this->ossConfig = $this->config->get('oss');
        $this->ossClient = new OssClient($this->ossConfig['ak'],$this->ossConfig['sk'],$this->ossConfig['host']);
        if ($this->ossClient == false) {
            throw new SwooleException('ossClinet初使化失败');
        }
     }

    /**
     * @return OssClient
     */
    public function getClient()
    {
        return $this->ossClient;
    }

    /**
     * @param $object
     * @param $file
     * @return string
     * @throws \OSS\Core\OssException
     */
    public function uploadFile($object,$file)
    {
        $res = $this->ossClient->uploadFile($this->ossConfig['bucket'], $object,$file);
        if ($res['info']['http_code'] != 200) {

        }
        return $this->getUrl($object);
    }

    /**
     * @param $object 文件名
     * @return string 网络路径
     */
    public function getUrl($object)
    {
        if ($this->ossConfig['cdn']) return $this->ossConfig['cdn'].'/'.$object;
        return $this->ossConfig['bucket'].'.'.$this->ossConfig['url'].'/'.$object;
    }

    /**
     * @param HttpInput $input
     * @return mixed 临时文件路径
     */
    public function getFile(HttpInput $input)
    {
        $file = $input->getFiles();
        if ($file['error'] === 0) {
            return $file['tmp_name'];
        }
    }

}