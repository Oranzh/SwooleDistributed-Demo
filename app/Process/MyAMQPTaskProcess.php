<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 17-9-15
 * Time: 下午2:28
 */

namespace app\Process;


use app\AMQPTasks\TestAMQPTask;
use Server\Components\AMQPTaskSystem\AMQPTaskProcess;

class MyAMQPTaskProcess extends AMQPTaskProcess
{

    public function start($process)
    {
        parent::start($process);
        //获取一个channel
        $channel = $this->connection->channel();
        //创建一个队列
        $channel->queue_declare("hhh");
        //框架默认提供的路由，也可以自己写
        $this->createDirectConsume($channel,'hhh');
        //等待所有的channel
        $this->connection->waitAllChannel();
    }

    /**
     * 路由消息返回class名称
     * @param $body
     * @return string
     */
    protected function route($body)
    {
        return TestAMQPTask::class;
    }

    protected function onShutDown()
    {
        // TODO: Implement onShutDown() method.
    }
}
