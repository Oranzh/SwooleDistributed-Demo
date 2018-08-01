<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/1
 * Time: 14:29
 */

namespace app\Aspects;

use Server\Components\AOP\Aspect;
use Server\CoreBase\HttpInput;
class BlueAspect extends Aspect
{
    protected $run_index_arr = [];
    protected $run_start_time;
    protected $http_input;

    public function init($own, $class_name, $name, $args)
    {
        parent::init($own, $class_name, $name, $args);
        $this->run_index_arr = [];
        $this->run_start_time = null;
        $this->http_input = new HttpInput();
    }

    public function before()
    {
        $cookie = $this->http_input->cookie('blue');
        $this->own->getContext()['logined'] = [
            'name' => 'lee',
            'sex' => 'male',
        ];
        var_dump('bluestart');
//        var_dump($cookie);
//        var_dump('blueover');
//        secho('blue',$cookie);
//        secho('aspect','before');
//        var_dump($this->class_name);
        get_instance()->getContext()['aspect'] = 'blue';
    }

    public function after()
    {
//        secho('aspect','after');
         var_dump($this->name);
    }
}