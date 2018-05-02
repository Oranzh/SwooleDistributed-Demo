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
use app\Models\AppModel;



class MyProcess extends Process
{
    protected $redisPool;
    protected $test;
    protected $table = 'users';
    protected $mysql;
    protected $AppModel;
    
    public function start($process)
    {
        $this->redis = new RedisAsynPool($this->config, $this->config->get('redis.active'));
        get_instance()->addAsynPool("redis",$this->redisPool);
        get_instance()->addAsynPool('test',new MysqlAsynPool($this->config, 'test'));
        $this->AppModel = get_instance()->loader->model(AppModel::class,$this);
    }

    public function getData()
    {
        if( $this->redis->getCoroutine()->exists('num') == false) {
            $this->redis->getCoroutine()->set('num',1);
        }
        for ($i = 1 ; $i <= 10 ; $i++) {
            $this->redis->getCoroutine()->incrBy('num',2);
            secho('['.date('Y-m-d H:i:s').' ] redisnum---',$this->redis->getCoroutine()->get('num'));
        }

//        $data = [
//            'user_name' => 'lee',
//            'email' => 'a@b.com'
//        ];
//        $res = $this->test->dbQueryBuilder->insert($this->table)->set($data)->query();

        return 'myprocess is done'.get_instance()->getWorkerId();
    }

    protected function onShutDown()
    {
        // TODO: Implement onShutDown() method.
    }
}