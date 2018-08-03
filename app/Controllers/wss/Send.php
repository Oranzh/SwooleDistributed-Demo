<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/3
 * Time: 16:59
 */

namespace app\Controllers\wss;



use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;

class Send extends Controller
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
        $uid = 'websocket_'.$this->client_data->uid;
        $content = $this->client_data->content;
        $this->sendToUid($uid,$content);
    }
}