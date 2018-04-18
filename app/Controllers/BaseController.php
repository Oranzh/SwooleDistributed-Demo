<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 22:18
 */

namespace app\Controllers;

use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;
use Server\SwooleMarco;
use app\Models\bus\User;
class BaseController extends Controller
{
    public $user;

    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->user = $this->loader->model(User::class,$this);
    }

    protected function getToken() {
        return $this->http_input->post('_t')??[];
    }

    protected function getLogined() {
        $token = $this->getToken();
        $info = $this->user->check_token($token);
        return $info;
    }

    /**
     * @param $output
     * @param int $flag 0成功 1失败
     */
    public function end($output , $flag=0)
    {
        $this->http_output->setHeader('Content-Type', 'application/json; charset=UTF-8');
        if (is_array($output)) {
            $output['flag'] = $flag;
        } else {
            $_output['msg'] = $output;
            $_output['flag'] = $flag;
            $output = $_output;
        }
        $end = json_encode($output, JSON_UNESCAPED_UNICODE);
        $this->http_output->end($end);
    }


    /**
     * 程序出错,发送日志到钉钉,不显示在客户端
     */
    public function onExceptionHandle(\Throwable $e, $handle = null)
    {
        parent::onExceptionHandle($e, function (\Throwable $e) {
            switch ($this->request_type) {
                case SwooleMarco::HTTP_REQUEST:
                    $this->end($e->getMessage(),1);
                    break;
                case SwooleMarco::TCP_REQUEST:
                    $this->send($e->getMessage());
                    break;
            }
        });
    }
}
