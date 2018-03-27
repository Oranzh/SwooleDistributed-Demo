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
        $this->redis = new RedisAsynPool($this->config, $this->config->get('redis.active'));
        $this->test = new MysqlAsynPool($this->config, 'test');
        get_instance()->addAsynPool("redis",$this->redisPool);
        get_instance()->addAsynPool("test",$this->test);
    }

    public function getData()
    {
//        $this->mysql = get_instance()->getAsynPool("test");
//        var_dump($this->mysql);
//        sleepCoroutine(3000);
        $num = $this->redis->getCoroutine()->get('num');
        secho('redisnum---start',$num);
        if( $this->redis->getCoroutine()->exists('num') == false) {
            $this->redis->getCoroutine()->set('num',1);
        }
        for ($i = 1 ; $i <= 10 ; $i++) {

            $this->redis->getCoroutine()->incrBy('num',2);
            secho('['.date('Y-m-d H:i:s').' ] redisnum---',$this->redis->getCoroutine()->get('num'));
        }

//        for($i = 0 ; $i < 10 ; $i++) {
//            $data = [
//                'user_name' => 'lee123',
//                'emails' => 'oranzh.cc@gmail.com',
//            ];
//            $this->mysql->insert($this->table)->set($data)->query();
//        }

        return 'myprocess task is done';
    }

    protected function onShutDown()
    {
        // TODO: Implement onShutDown() method.
    }
}