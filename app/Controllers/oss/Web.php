<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/13
 * Time: 13:59
 */

namespace app\Controllers\oss;


use app\Controllers\BaseController;

class Web extends BaseController
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
        if ($this->isGet()) {
            $data = [
                'msg' => 'ok',
                'content' => 'this is blade view',
            ];
            $this->getView($data);
        }
    }
}