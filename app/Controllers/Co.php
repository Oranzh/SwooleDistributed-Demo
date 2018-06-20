<?php

namespace app\Controllers;

use app\Models\AppModel;
use app\Models\wiki\Ssc;
use app\Tasks\AppTask;
use Server\CoreBase\ChildProxy;



/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:51
 */
class Co extends BaseController
{
    /**
     * @var AppModel
     */
    protected $var;
    protected $task;

    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);


    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function http_echo()
    {
        $this->end('ok');
    }

    public function http_taskErr()
    {
        $this->task = $this->loader->task(AppTask::class);
        $res = $this->task->err();
        $this->end($res);

    }

    public function http_get()
    {
        $this->end($this->var);
        $this->destroy();
    }

    public function http_null()
    {
        $res = is_null(null);
        $this->end($res);
    }

    public function http_str2bin()
    {
        $value = unpack('H*', "Stack");
        $res = base_convert($value[1], 16, 2);
        //$res = bin2hex($res);
        /**
         * // Convert a string into binary
        // Should output: 0101001101110100011000010110001101101011
        $value = unpack('H*', "Stack");
        echo base_convert($value[1], 16, 2);

        // Convert binary into a string
        // Should output: Stack
        echo pack('H*', base_convert('0101001101110100011000010110001101101011', 2, 16));
         */
        $this->end($res);
    }

    public function http_str2hex()
    {
        $str = $this->http_input->get('str');
        $res = $this->strToHex($str);
        $this->end($res);
    }

    public function http_hex2str()
    {
        $hex = '447B22636F6E74726F6C6C65725F6E616D65223A225773222C226D6574686F645F6E616D65223A22737562222C22737562223A2266697273745F746F706963227D';
        $res = pack("H*", $hex);
        $this->end($res);

    }
    protected function strToHex($string){
        $hex = '';
        for ($i=0; $i<strlen($string); $i++){
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0'.$hexCode, -2);
        }
        return strToUpper($hex);
    }
    protected function hexToStr($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }

    public function http_task()
    {
        $task = $this->loader->task(AppTask::class);
        $task->err();
        $this->end(123);
    }

    public function http_ex()
    {
        $col = function (){};
        $res = serialize($col);
        $this->end('ok');
    }

    public function http_hi()
    {
		$time = date('Y-m-d H:i:s',time());
        $this->end($time);
    }

    public function http_conf()
    {
        $port = get_instance()->config->get('mailer.port');
        $this->end($port);
    }

    public function http_ssc()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->api2();
        $this->end($res);
    }


}
