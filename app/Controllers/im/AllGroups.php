<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/10
 * Time: 15:26
 */

namespace app\Controllers\im;


use app\Controllers\BaseController;
use app\Models\service\Group;

class AllGroups extends BaseController
{
    private $sGroup;
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->sGroup = $this->loader->model(Group::class,$this);
    }

    public function http_perform()
    {
        $groups = $this->sGroup->getAll();
        $this->end(['allGroups' => $groups ]);
    }
}