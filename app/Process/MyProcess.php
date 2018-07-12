<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 17-8-15
 * Time: 上午10:52
 */

namespace app\Process;

use app\Models\service\MysqlService;
use Server\Components\Process\Process;
use Server\Asyn\Redis\RedisAsynPool;
use Server\Asyn\Mysql\MysqlAsynPool;
use app\Models\AppModel;
use Server\Components\Process\ProcessManager;
use Server\CoreBase\Model;
use Server\Asyn\Mysql\Miner;
use oranzh\Oranzh;



class MyProcess extends Process
{
    protected $redisPool;
    protected $mysqlPool;
    protected $db;
    protected $table = 'users';

    //如果需要设置代理，这块需this->setRPCProxy(new Oranzh($this))
    public function __construct($name, $worker_id, $coroutine_need = true)
    {
        parent::__construct($name, $worker_id, $coroutine_need);
        //$this->setRPCProxy(new Oranzh($this));
    }

    public function start($process)
    {
        $this->redisPool = new RedisAsynPool($this->config, $this->config->get('redis.active'));
        $this->mysqlPool = new MysqlAsynPool($this->config, $this->config->get('mysql.active'));
        get_instance()->addAsynPool("redisPool",$this->redisPool);
        get_instance()->addAsynPool("mysqlPool",$this->mysqlPool);
    }

    public function redis()
    {
        if( $this->redisPool->getCoroutine()->exists('num') == false) {
            $this->redisPool->getCoroutine()->set('num',1);
        }
        for ($i = 1 ; $i <= 10 ; $i++) {
            $this->redisPool->getCoroutine()->incrBy('num',2);
            secho('['.date('Y-m-d H:i:s').' ] redisnum---',$this->redisPool->getCoroutine()->get('num'));
        }

        return 'myprocess is done'.get_instance()->getWorkerId();
    }

    public function mysql()
    {
        $this->db = get_instance()->loader->mysql('mysqlPool',$this);
		$res = $this->db->select('*')->from($this->table)->query();
        return $res->getResult();
    }

    public function service()
    {
        $service = get_instance()->loader->model(MysqlService::class,$this);
        $res = $service->select();
        return $res;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function transferParam($param)
    {
        return 'param is '.$param;
    }

    protected function onShutDown()
    {
        // TODO: Implement onShutDown() method.
        //代表进程结束的回调，伴随服务器的关闭，管理进程会逐一执行进程的onShutDown方法，这里可以做进程的收尾操作。
        //测试方法 kill 掉此自定义进程，看控制台日志
        secho('MyProcess','shutdown');
    }
}
