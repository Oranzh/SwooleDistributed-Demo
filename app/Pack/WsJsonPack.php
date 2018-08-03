<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午2:43
 */

namespace app\Pack;

use Server\CoreBase\SwooleException;
use Server\Pack\Ipack;

class WsJsonPack implements IPack
{
    protected $last_data;
    protected $last_data_result;


    public function pack($data, $topic = null)
    {
        var_dump('wsjson---pack');
        if ($this->last_data != null && $this->last_data == $data) {
            return $this->last_data_result;
        }
        $this->last_data = $data;
        $this->last_data_result = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $this->last_data_result;
    }

    public function unPack($data)
    {
        var_dump('wsjson---unpack');
        $value = json_decode($data);
        var_dump($data);

        if (empty($value)) {
            throw new SwooleException('json unPack 失败');
        }
        return $value;
    }

    function encode($buffer)
    {
        var_dump('wsjson---encode');
    }

    function decode($buffer)
    {
        var_dump('wsjson---decode');
    }

    public function getProbufSet()
    {
        return null;
    }

    public function errorHandle(\Throwable $e, $fd)
    {
        //get_instance()->close($fd);
    }
}