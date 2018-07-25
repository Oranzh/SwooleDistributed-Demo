<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/3/30
 * Time: 17:37
 */

namespace app\Controllers\wiki;

use app\Controllers\BaseController;
use Server\CoreBase\ChildProxy;
use Respect\Validation\Validator as v;


class Http extends BaseController
{

    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        //这里做一些初使化,比如loader service
    }


    public function http_perform()
    {
        $res = $this->verfiy();
        $this->end(sprintf('my name is %s and age is %d',$res['name'],$res['age']));
	}

    /**
     * 验证参数
     */
    private function verfiy()
    {
        $arr = $this->http_input->getAllGet();
        v::arrayVal()->key('name', v::stringType()->length(1, 30))
            ->key('age', v::intVal()->between(20, 30))->check($arr);
        return $arr;
	}
}
