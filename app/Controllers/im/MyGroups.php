<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/10
 * Time: 14:24
 */

namespace app\Controllers\im;


use app\Controllers\BaseController;
use app\Models\service\GroupPassport;

class MyGroups extends BaseController
{
    private $sGroupPassport;
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->sGroupPassport = $this->loader->model(GroupPassport::class,$this);
    }

    public function http_perform()
    {
        $sess = $this->needLogin();
        $groups = $this->sGroupPassport->getGroupsByPassport($sess['id']);
        $this->end(['groups' => $groups]);
    }


}