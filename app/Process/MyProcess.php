<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 17-8-15
 * Time: 上午10:52
 */

namespace app\Process;

use Server\Components\Process\Process;
use Server\Asyn\Redis\RedisAsynPool;
use Server\Asyn\Mysql\MysqlAsynPool;
use Server\CoreBase\CoreBase;


class MyProcess extends Process
{
    protected $redisPool;
    protected $test;
    protected $table = 'users';
    protected $mysql;
    
    public function start($process)
    {
        $this->redisPool = new RedisAsynPool($this->config, $this->config->get('redis.active'));
        $this->test = new MysqlAsynPool($this->config, 'test');
        get_instance()->addAsynPool("redisPool",$this->redisPool);
        get_instance()->addAsynPool("test",$this->test);

//        if ($this->test != null) {
//            $this->installMysqlPool($this->test);
//        }
    }

    public function getData()
    {
        $this->mysql = get_instance()->getAsynPool("test");
        var_dump($this->mysql);
        sleepCoroutine(3000);
        if( $this->redisPool->getCoroutine()->exists('num') == false) {
            $this->redisPool->getCoroutine()->set('num',1);
        }

        for($i = 0 ; $i < 10 ; $i++) {
            $data = [
                'user_name' => 'lee123',
                'emails' => 'oranzh.cc@gmail.com',
            ];
            $this->mysql->insert($this->table)->set($data)->query();
        }

        return 'myprocess task is done';
    }

    protected function onShutDown()
    {
        // TODO: Implement onShutDown() method.
    }
}