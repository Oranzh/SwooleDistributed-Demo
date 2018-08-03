<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/3
 * Time: 12:31
 */

namespace app\Controllers\wss;

use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;

class OnClose extends Controller
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
        $this->destroy();
    }
}