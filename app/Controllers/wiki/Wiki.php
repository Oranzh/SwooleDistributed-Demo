<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/3/30
 * Time: 17:37
 */

namespace app\Controllers\wiki;


use app\BlueException;
use app\BlueWarningException;
use app\Controllers\BaseController;
use app\Models\wiki\Ssc;
use app\Tasks\tools\OssTask;
use oranzh\Qrcode;
use Server\CoreBase\ChildProxy;
use voku\helper\UTF8;


class Wiki extends BaseController
{

    protected $redis1;
    protected $mysql;
    protected $weixin;
    protected $test;
    protected $oss;
    protected $ssc;
    protected $hr;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->test = get_instance()->getAsynPool("test");
        $this->ssc = get_instance()->getAsynPool("ssc");
        $this->hr = get_instance()->getAsynPool("hr");
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        if ($this->test != null) {
            $this->installMysqlPool($this->test);
        }
        $this->oss = $this->loader->task(OssTask::class);
    }


    public function http_tpl()
    {
        $this->http_output->setHeader('Content-Type', 'text/html; charset=UTF-8');
        if ('GET' === $this->http_input->getRequestMethod()) {
            $data = [
                'name' => 'lee',
                'sex' => 'male'
            ];
            $tpl = $this->loader->view('app::wiki/page/user/detail/main', $data);
            $this->http_output->end($tpl);
        }
        $name = $this->http_input->getPost('name');
        $emails = $this->http_input->getPost('emails');
        $data = [
            'user_name' => $name,
            'emails' => $emails,
        ];
        $res = $this->db->insert('users')->set($data)->query();
        $res = $res->getResult();
        $this->http_output->end($res);

    }

    /*
     * 测试钉钉机器人日志,请勿一直请求
     */
    public function http_throw()
    {
        $this->http_output->end($res);
    }


    public function http_ex()
    {
        throw new BlueWarningException('This is Warning');
    }



    public function http_day()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->day();
        $this->http_output->end($res);
    }

    public function http_record()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->records();
        $this->http_output->end($res);
    }

    public function http_qrcode()
    {
        $qrcode = new Qrcode(250,'hello,this is sd framework','UTF-8');
        $url = $qrcode->getUrl();
//        $url = file_get_contents($url);
//        $url = $this->oss->uploadFileByContent('qrcode',$url);
        $this->http_output->end($url);
    }

    public function http_sy()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->shouyi();
        $this->http_output->end($res);
    }

    public function http_ynvi()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->ynvi();
        $this->http_output->end($res);
    }

}