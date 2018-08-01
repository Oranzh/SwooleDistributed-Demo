<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 22:18
 */

namespace app\Controllers;

use app\Exception\BlueFatalException;
use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;
use Server\CoreBase\SwooleInterruptException;
use Server\CoreBase\SwooleRedirectException;
use Server\SwooleMarco;
use app\Exception\BlueWarningException;
use Respect\Validation\Exceptions\ExceptionInterface;


class BaseController extends Controller
{
    private $hookNeedLogin = false;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        if ($this->request_type == SwooleMarco::HTTP_REQUEST) $this->context['ip'] = $this->request->header['x-real-ip'];
        $this->setUp();
    }

    public function setUp()
    {
    }

    public function needLogin()
    {
        //secho('login','返回用户信息,如果没有让登陆去');
        $this->context['logined'] = [
            'name' => 'lee',
            'tel' => 15249232349,
        ];
    }

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
        //必须的代码
        if ($e instanceof SwooleRedirectException) {
            $this->http_output->setStatusHeader($e->getCode());
            $this->http_output->setHeader('Location', $e->getMessage());
            $this->http_output->end('end');
            return;
        }
        //中断信号
        if ($e instanceof SwooleInterruptException) {
            return;
        }
        if ($e instanceof SwooleException) {
            secho("EX", "--------------------------[报错指南]----------------------------" . date("Y-m-d h:i:s"));
            secho("EX", "异常消息：" . $e->getMessage());
            print_context($this->getContext());
            secho("EX", "--------------------------------------------------------------");
        }
        //如果是HTTP传递request过去
        if ($this->request_type == SwooleMarco::HTTP_REQUEST) {
            $e->request = $this->request;
        }
        //生成错误数据页面
        $error_data = get_instance()->getWhoops()->handleException($e);
        if ($this->isEnableError) {
            try {
                //判断为跳转的时候不中断程序,要不无法跳转
                if ($e instanceof ExceptionInterface or $e instanceof BlueWarningException or $e instanceof SwooleInterruptException or $e instanceof SwooleRedirectException) {

                } else {
                    $this->Error->push($e->getMessage(),$error_data);
                }
            } catch (Throwable $e) {
            }
        }

        //可以重写的代码
        if ($handle == null) {
            switch ($this->request_type) {
                case SwooleMarco::HTTP_REQUEST:
                    $this->end($e->getMessage(), 1);
                    break;
                case SwooleMarco::TCP_REQUEST:
                    $this->send($e->getMessage());
                    break;
            }
        } else {
            sd_call_user_func($handle, $e);
        }
    }

    public function getView(array $data=[])
    {
        $tpl = $this->http_input->getPathInfo();
        $tpl = 'app::page'.strtolower($tpl).'/main';
		var_dump($tpl);
        $tpl = $this->loader->view($tpl,$data);
        $this->http_output->end($tpl);
        $this->interrupt();
    }
}
