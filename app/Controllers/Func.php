<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/20
 * Time: 16:32
 */

namespace app\Controllers;

use Server\CoreBase\Controller;

class Func extends Controller
{
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function http_perform()
    {
        $this->redirect('https://www.baidu.com');
        $this->http_output->end(123);
    }
}
