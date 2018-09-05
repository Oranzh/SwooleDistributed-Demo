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
use app\Controllers\BaseController;

class Bind extends BaseController
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
        $uid = $this->client_data->uid;
        $uid = 'websocket_'.$uid;
        if ($this->uid) {
            $this->send('Error');
        } else {
            $this->bindUid($uid);
            $this->send('bind successfully');
        }
    }
}
