<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/17
 * Time: 9:05
 */

namespace app\Controllers\bus;


use app\Controllers\BaseController;
use Server\CoreBase\ChildProxy;

class Ws extends BaseController
{
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    /*
     * 绑定UID
     */
    public function bind()
    {
        $uid = $this->client_data->uid;
        $this->bindUid($uid);
        $this->send("bind from server--ok----.$uid");
    }
    public function sub()
    {
        $sub = $this->client_data->sub;
        $this->addSub($sub);
        $this->send("ok-----{$this->fd}");
    }

    public function sendToOnes()
    {
        $uids = $this->client_data->uids;
        $content = $this->client_data->content;
        $this->sendToUids($uids,$content);
    }

    public function http_remove()
    {
        $sub = $this->http_input->get('sub');
        $fd = (int)$this->http_input->get('fd');
        get_instance()->removeSub($sub, $fd);
        $this->http_output->end("ok");
    }

    public function pub()
    {
        $sub = $this->client_data->sub;
        $data = $this->client_data->data;
        $this->sendPub($sub, $data);
    }

    public function http_pub()
    {
        $this->sendPub('sd*123', 'sendPub function');
    }

    public function sendAll($data)
    {
        $this->sendToAll($data);
    }

    public function onClose()
    {
        $this->destroy();
    }


    public function onConnect()
    {
        $msg = 'connect to a server'.$this->fd;
        get_instance()->protect($this->fd);
        $this->send($msg);

    }


    public function  http_sendToOne()
    {
        $uid = $this->http_input->get('uid');
        $data = $this->http_input->get('content');
        $this->sendToUid($uid,$data);
    }

    /*
     * 获取topic的订阅数
     * 仅限绑定uid用户
     */
    public function http_getAllTopic() {
        $res = get_instance()->getSubMembersCountCoroutine('sd*123');
        $this->http_output->end($res);
    }

    /**
     * 通过UID获取该用户的所有订阅
     * [
    "sd*123",
    "sd*123/first",
    "sd*123/second",
    "sd*123/second/disanji"
    ]
     */
    public function http_getUidTopicsCoroutine ()
    {
        $res = get_instance()->getUidTopicsCoroutine('sd_15');
        $this->http_output->end($res);
    }

    /**
     * 根据Topic获取订阅用户UID
     */
    public function http_getSubMembersCoroutine ()
    {
        $res = get_instance()->getSubMembersCoroutine('sd*123');
        $this->http_output->end($res);
    }


}