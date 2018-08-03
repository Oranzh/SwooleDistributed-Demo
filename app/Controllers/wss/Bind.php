<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/3
 * Time: 12:34
 */

namespace app\Controllers\wss;

use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;
use app\Exception\BlueWarningException;

class Bind extends Controller
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
        var_dump('come here wss bind perform');
        $uid = $this->client_data->uid;
        $uid = 'websocket_'.$uid;
        //if (!empty($this->uid)) throw new BlueWarningException('请勿重复绑定');
        $this->bindUid($uid);
        $this->send('haha');

    }
}