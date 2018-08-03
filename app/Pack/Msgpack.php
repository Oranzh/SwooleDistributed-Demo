<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/3
 * Time: 17:07
 */

namespace app\Pack;

use Server\CoreBase\SwooleException;
use Server\Pack\Ipack;

class Msgpack implements IPack
{
    protected $last_data;
    protected $last_data_result;


    public function pack($data, $topic = null)
    {
        if ($this->last_data != null && $this->last_data == $data) {
            return $this->last_data_result;
        }
        $this->last_data = $data;
        $this->last_data_result = msgpack_pack($data);
        return $this->last_data_result;
    }

    public function unPack($data)
    {
        $res = new \stdClass();
        $value = msgpack_unpack($data);
        if (empty($value)) {
            throw new SwooleException('msgpack unPack 失败');
        }
        foreach ($value as $k => $v) {
            $res->$k = $v;
        }
        return $res;
    }

    function encode($buffer)
    {
        var_dump('msgpack---encode');
    }

    function decode($buffer)
    {
        var_dump('msgpack---decode');
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