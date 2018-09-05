<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/13
 * Time: 17:40
 */

namespace app\Controllers\oss;


use app\Controllers\BaseController;

class Upload extends BaseController
{
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