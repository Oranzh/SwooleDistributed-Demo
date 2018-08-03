<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/7/19
 * Time: 3:01
 */

namespace app\Controllers\sd3;


use app\Controllers\BaseController;
use Server\CoreBase\ChildProxy;
use Respect\Validation\Validator as v;

class Create extends BaseController
{
    private $cSd3Create;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name); // TODO: Change the autogenerated stub
        $this->cSd3Create = $this->loader->model('commit/sd3/Create',$this);
    }
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->needLogin();
    }

    public function http_perform()
    {
        if ($this->isGet()) {
            $this->getView();
        }
        $params = $this->verify();
        $this->context['commit'] = $params;
        $this->cSd3Create->perform();
        $this->context['insert_id'] = 217;
        $this->redirectController('sd3','info');
        $this->end('添加成功');
    }

    private function verify()
    {
        $params = $this->http_input->getAllPost();
        v::arrayVal()->key('num',v::intVal()->min(1,true))
            ->key('user_name', v::stringType()->length(1, 20))
            ->key('emails', v::email())
            ->key('num',v::intVal()->between(1, 200))
            ->check($params);
        return $params;
    }
}