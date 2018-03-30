<?php
namespace app;

use Server\CoreBase\HttpInput;
use Server\CoreBase\Loader;
use Server\SwooleDistributedServer;
use Server\Components\Process\ProcessManager;
use Server\Asyn\Redis\RedisAsynPool;
use Server\Asyn\Mysql\MysqlAsynPool;
use app\Process\MyProcess;
use Server\Asyn\HttpClient\HttpClientPool;

/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-9-19
 * Time: 下午2:36
 */
class AppServer extends SwooleDistributedServer
{
    /**
     * 可以在这里自定义Loader，但必须是ILoader接口
     * AppServer constructor.
     */
    public function __construct()
    {
        $this->setLoader(new Loader());
        parent::__construct();
    }

    /**
     * 开服初始化(支持协程)
     * @return mixed
     */
    public function onOpenServiceInitialization()
    {
        parent::onOpenServiceInitialization();
    }

    /**
     * 这里可以进行额外的异步连接池，比如另一组redis/mysql连接
     * @param $workerId
     * @return array
     */
    public function initAsynPools($workerId)
    {
        parent::initAsynPools($workerId);
        $this->asynPools = [];
        if ($this->config->get('redis.enable', true)) {
            $this->asynPools['redisPool'] = new RedisAsynPool($this->config, $this->config->get('redis.active'));
        }
        if ($this->config->get('mysql.enable', true)) {
            $this->asynPools['mysqlPool'] = new MysqlAsynPool($this->config, $this->config->get('mysql.active'));
            $this->addAsynPool('sd',new MysqlAsynPool($this->config, 'sd'));
        }
        $this->redis_pool = $this->asynPools['redisPool'] ?? null;
        $this->mysql_pool = $this->asynPools['mysqlPool'] ?? null;
        //$this->addAsynPool('GetIPAddress', new HttpClientPool($this->config, 'http://int.dpool.sina.com.cn'));
        $this->addAsynPool('WeiXinAPI',new HttpClientPool($this->config,'https://open.weixin.qq.com'));
        $this->addAsynPool('WeiXin',new HttpClientPool($this->config,'https://api.weixin.qq.com'));

    }

    /**
     * 用户进程
     */
    public function startProcess()
    {
        parent::startProcess();
        ProcessManager::getInstance()->addProcess(MyProcess::class);
    }

    /**
     * 可以在这验证WebSocket连接,return true代表可以握手，false代表拒绝
     * @param HttpInput $httpInput
     * @return bool
     */
    public function onWebSocketHandCheck(HttpInput $httpInput)
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCloseMethodName()
    {
        return 'onClose';
    }

    /**
     * @return string
     */
    public function getEventControllerName()
    {
        return 'AppController';
    }

    /**
     * @return string
     */
    public function getConnectMethodName()
    {
        return 'onConnect';
    }


}