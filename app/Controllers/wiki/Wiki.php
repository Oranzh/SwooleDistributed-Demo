<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/3/30
 * Time: 17:37
 */

namespace app\Controllers\wiki;


use app\Exception\BlueException;
use app\Exception\BlueFatalException;
use app\Exception\BlueWarningException;
use app\Controllers\BaseController;
use app\Tasks\tools\OssTask;
use oranzh\Qrcode;
use Server\CoreBase\ChildProxy;


class Wiki extends BaseController
{

    protected $redis1;
    protected $mysql;
    protected $weixin;
    protected $test;
    protected $oss;
    protected $ssc;
    protected $hr;
    public $db;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
//        $this->test = get_instance()->getAsynPool("test");
//        $this->ssc = get_instance()->getAsynPool("ssc");
//        $this->hr = get_instance()->getAsynPool("hr");
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
//        if ($this->test != null) {
//            $this->installMysqlPool($this->test);
//        }
//        $this->oss = $this->loader->task(OssTask::class);
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


    public function http_qrcode()
    {
        $qrcode = new Qrcode(250,'hello,this is sd framework','UTF-8');
        $url = $qrcode->getUrl();
        $this->http_output->end($url);
    }

    /**
     * 主要更新，优化了loader机制和mysql
    1.使用mysql，redis，不再需要以前的方法获取了，现在统一用loader。
    $this->db = $this->loader->mysql("mysqlPool",$this);
    $this->redis = $this->loader->redis("redisPool");
    2.begin开始事务后，回调中调用modle方法也会当作事务处理。

    $this->db->begin(function (){ $this->MTest->test();
    $this->MTest->test2();
    });
     */
    public function http_db()
    {
        $this->db = $this->loader->mysql("mysqlPool",$this);
        $data = [
            'user_name' => 'lee123'.rand(1000,9999),
            'emails' => 'oranzh.cc@gmail.com',
        ];
        $res = $this->db->insert('users')->set($data)->query();
        $msg = $res->getResult();
        $this->end($msg);

    }

    
}
