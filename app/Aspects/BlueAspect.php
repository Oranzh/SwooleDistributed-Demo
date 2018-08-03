<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/1
 * Time: 14:29
 */

namespace app\Aspects;

use Server\Components\AOP\Aspect;
class BlueAspect extends Aspect
{
    protected $run_index_arr = [];
    protected $run_start_time;

    public function init($own, $class_name, $name, $args)
    {
        parent::init($own, $class_name, $name, $args);
        $this->run_index_arr = [];
        $this->run_start_time = null;
    }

    public function before()
    {
    }

    public function after()
    {
    }

}
