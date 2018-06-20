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
use app\Exception\BlueWarningException;

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
        //$this->user = $this->loader->model(User::class, $this);
    }

//    protected function getToken()
//    {
//        return $this->http_input->getPost('_t');
//    }
//
//    protected function getLogined()
//    {
//        $token = $this->getToken();
//        $info = $this->user->getInfo($token);
//        if (empty($info)) throw new BlueWarningException('需要登录');
//        return $info;
//    }

    /**
     * @param $output
     * @param int $flag 0成功 1失败
     */
    public function end($output, $flag = 0, $gzip = true)
    {
        $this->http_output->setHeader('Access-Control-Allow-Origin', '*');
        $this->http_output->setHeader('Content-Type', 'application/json; charset=UTF-8');
        if (is_array($output)) {
            $output['flag'] = $flag;
        } else {
            $_output['msg'] = $output;
            $_output['flag'] = $flag;
            $output = $_output;
        }
        $end = json_encode($output, JSON_UNESCAPED_UNICODE);
        $this->http_output->end($end, $gzip);
    }

    protected function isGet() {
        return ($this->http_input->getRequestMethod() === 'GET') ? TRUE : FALSE;
    }


    /**
     * 程序出错,发送日志到钉钉,不显示在客户端
     */
    public function onExceptionHandle(\Throwable $e, $handle = null)
    {
        parent::onExceptionHandle($e, function (\Throwable $e) {
            switch ($this->request_type) {
                case SwooleMarco::HTTP_REQUEST:
                    $this->end($e->getMessage(), 1);
                    break;
                case SwooleMarco::TCP_REQUEST:
                    $this->send($e->getMessage());
                    break;
            }
        });
    }

    public function getView()
    {
        $tpl = $this->http_input->getPathInfo();
        return 'app::page'.strtolower($tpl).'/main';
    }
}
