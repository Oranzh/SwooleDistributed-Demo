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

class BaseController extends Controller
{
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }


    /**
     * @param $output
     * @param int $flag 0成功 1失败
     */
    public function end($output , $flag=0)
    {
        //$res['data'] = [];
        $this->http_output->setHeader('Content-Type', 'application/json; charset=UTF-8');
//        try {
//            $res['data'] = array_merge($res['data'],$output);
//            $res['flag'] = 0;
//        }catch (BlueException $exception) {
//            $res['flag'] = 1;
//            $res['message'] = $exception->getMessage();
//            $res['code'] = $exception->getTraceAsString();
//        }
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
     * @param $token
     * @return bool|array
     */
    public function check_token($token)
    {
        $token = decode_aes($token['encrypted'],$token['hash_key'],true);
        if (empty($token) or empty($token['time']))  return false;
        if ($token['expire']) {

        } else {
            //默认15天
            if ($token['time'] + 86400 * 15 > time()) return false;
        }
        return $token;
    }
    /**
     * 程序出错,发送日志到钉钉,不显示在客户端
     */
    public function onExceptionHandle(\Throwable $e, $handle = null)
    {
        parent::onExceptionHandle($e, function (\Throwable $e) {
            switch ($this->request_type) {
                case SwooleMarco::HTTP_REQUEST:
                    $this->end($e->getMessage().' on Line '.$e->getLine(),1);
                    break;
                case SwooleMarco::TCP_REQUEST:
                    $this->send($e->getMessage(),1);
                    break;
            }
        });
    }
}
