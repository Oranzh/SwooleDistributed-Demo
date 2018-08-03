<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/3
 * Time: 12:28
 */

namespace app\Controllers\wss;

use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;

class OnConnect extends Controller
{
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);

    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function perform()
    {
        get_instance()->protect($this->fd);
//        {"controller_name":"Ws","method_name":"bind","uid":"sd_15"}
        $msg = [
            'controller_name' => 'Ws',
            'method_name' => 'bind',
            'uid' => 'first_topic'
        ];
        $this->send($msg);

    }
}