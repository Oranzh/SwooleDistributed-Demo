<?php

namespace app\Controllers;

use app\Models\AppModel;
use app\Models\ImageModel;
use oranzh\Oranzh;
use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;
use app\Process\MyProcess;
use Server\Components\Process\ProcessManager;
use app\Tasks\tools\OssTask;
use Server\CoreBase\SwooleException;
use Server\CoreBase\SwooleInterruptException;
use Server\Components\CatCache\TimerCallBack;


/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:51
 */
class AppController extends Controller
{
    /**
     * @var AppModel
     */
    public $AppModel;
    public $ImageModel;
    protected $redis;
    private $mysql;
    protected $weixin;
    protected $sd;
    protected $oss;
    protected $hr;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->redis = get_instance()->getAsynPool("redisPool");
        $this->mysql = get_instance()->getAsynPool("mysqlPool");
        $this->test = get_instance()->getAsynPool("test");
        $this->weixin = get_instance()->getAsynPool("WeiXinAPI");
        $this->weixinApi = get_instance()->getAsynPool("WeiXin");
        $this->hr = get_instance()->getAsynPool("hr");

    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        if ($this->mysql != null) {
            $this->installMysqlPool($this->mysql);
        }
        if ($this->sd != null) {
            secho('sd','is not null');
            $this->installMysqlPool($this->sd);
        }
        $this->AppModel = $this->loader->model('AppModel', $this);
        $this->ImageModel = $this->loader->model('ImageModel', $this);
        $this->redis = get_instance()->getAsynPool("redisPool");
    }

    public function http_sd() {

        $this->http_output->end(123);
    }
    public function http_test1()
    {
        $redirect_uri = 'http://www.oranzh.cc';
        $response = $this->weixin->httpClient->setQuery([
                    'appid' => 'wx795a5c932e219054',
                    'redirect_uri' => urlencode($redirect_uri),
                    'response_type'=>'code',
                    'scope'=>'snsapi_userinfo',
                    'state'=>'1#wechat_redirect',
                ])->coroutineExecute('/connect/oauth2/authorize');
        secho('wechat_response',$response);
        $this->http_output->end('ok');
    }

    public function http_test2()
    {
        $response = $this->weixinApi->httpClient->setQuery([
            'appid' => 'wx795a5c932e219054',
            'grant_type' => 'client_credential' ,
            'secret'=>'37e9353d6eddd683290e0400a0287d6b',
        ])->coroutineExecute('/cgi-bin/token');
        secho('wechat_response',$response);
        $this->http_output->end('ok');
    }


    public function http_redisNum() {
        $this->redis->getCoroutine()->incr('num');
        $res = $this->redis->getCoroutine()->get('num');
        $this->http_output->end($res);
    }

    public function http_model() {
        $res = $this->AppModel->mysql();
        $this->http_output->end($res);
    }

    public function http_model2() {
        $res = $this->AppModel->getAll();
        $this->http_output->end($res);
    }



    public function http_ab() {
        $data = [
            'name' => 'leexiaohui',
            'age' => 28,
            'height' => 183,
            'sex' => 'male'
        ];

        $this->http_output->end($data,false);
    }



    public function bind()
    {
        var_dump($this->client_data);
        $uid = $this->client_data->uid;
        $this->bindUid($uid);
        $this->send("bind from a server--ok.$uid");
    }
    public function sub()
    {
        $sub = $this->client_data->sub;
        var_dump($sub);
        $this->addSub($sub);
        $this->send("ok.$this->fd");
    }

    public function sendToOnes()
    {
        $uids = $this->client_data->uids;
        $content = $this->client_data->content;
        $this->sendToUids($uids,$content);
    }

    public function http_remove()
    {
        $sub = $this->http_input->get('sub');
        $fd = (int)$this->http_input->get('fd');
        get_instance()->removeSub($sub, $fd);
        $this->http_output->end("ok");
    }

    public function pub($sub, $data)
    {
        var_dump($sub);
        $this->sendPub($sub, $data);
    }

    public function http_pub()
    {
        $this->sendPub('test', 1);
    }

    public function sendAll($data)
    {
        $this->sendToAll($data);
    }

    public function onClose()
    {
        $this->destroy();
    }

    public function onConnect()
    {
        $msg = 'connect to a server'.$this->fd;
        //get_instance()->protect($this->fd);
        $this->send($msg);

    }

    public function http_test()
    {
        $this->http_output->end(1123);
    }
    public function  http_sendToOne()
    {
        $uid = $this->http_input->get('uid');
        $data = $this->http_input->get('content');
        secho('--aaaa--fromuid-----',$this->uid);
        //$uid = $this->client_data->uid;
        secho('--aaaa--touid-----',$uid);
        //$data = $this->client_data->content.'send from a server';
        $this->sendToUid($uid,$data);
    }

    public function http_getAllTopic() {
        $res = get_instance()->getSubMembersCountCoroutine('sdsd');
        $this->http_output->end($res);
    }

    public  function http_sql() {
        $res = $this->db->query("
            CREATE TABLE IF NOT EXISTS `MysqlTest` (
              `peopleid` smallint(6) NOT NULL AUTO_INCREMENT,
              `firstname` char(50) NOT NULL,
              `lastname` char(50) NOT NULL,
              `age` smallint(6) NOT NULL,
              `townid` smallint(6) NOT NULL,
              PRIMARY KEY (`peopleid`),
              UNIQUE KEY `unique_fname_lname`(`firstname`,`lastname`),
              KEY `fname_lname_age` (`firstname`,`lastname`,`age`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ");
        $this->http_output->end($res);
    }

    public function http_slb() {
        $this->http_output->end('this is a',false);
    }

    public function http_process() {
        $res = ProcessManager::getInstance()->getRpcCall(MyProcess::class,'auto','my_process'.rand(1,5))->getData();
        $this->http_output->end($res);
    }

    public function http_oss() {
        $this->http_output->setHeader('Content-Type', 'text/html; charset=UTF-8');
        $start = getMillisecond();
        $this->oss = $this->loader->task(OssTask::class,$this);
        $size = filesize('/home/lee/pexels-photo-175773.jpeg');
        $size = $size/1024/1024;
        $res = $this->oss->uploadFile('sdossTest'.time(),'/home/lee/pexels-photo-175773.jpeg');
        $this->ImageModel->insert($res);
        $end = getMillisecond();
        $time = $end - $start;
        $this->http_output->end('图片大小 '.$size.'M------耗时 '.$time."  ms ------图片地址 :" .$res);

    }

    public function http_oss2() {
        $this->http_output->setHeader('Content-Type', 'text/html; charset=UTF-8');
        $start = getMillisecond();
        $this->oss = $this->loader->task(OssTask::class,$this);
        $file = '/home/lee/123.png';
        $size = filesize($file);
        $size = $size/1024/1024;
        $content = file_get_contents($file);
        $res = $this->oss->uploadFileByContent('sdossTest'.time(),$content);
        $end = getMillisecond();
        $time = $end - $start;
        secho('oss2---',$res);
        $this->http_output->end('图片大小 '.$size.'M------耗时 '.$time."  ms ------图片地址 :" .$res);

    }

    public function http_ex1()
    {
        throw new SwooleException('这里是错误');
        $this->http_output->end('123');
    }

    public function http_encode() {
        //$data = 'leexiaohui';
        $data = $this->http_input->get('data');
        $data = [
            'name' => 'leexiaohui',
            'sex' => 'male'
        ];
        $data = new \StdClass();
        $data->age = 27;
        $data->sex = 'male';
        if(empty($data)) throw new SwooleException('请get传data');
        $key = 'oranzh';
        $res = encode_aes($data,$key,true);
        $this->http_output->end($res);
    }

    public function http_decode() {
        $data = $this->http_input->get('data');
        $key = $this->http_input->get('key');
//        $key = '$2y$12$Q2ON/Vl9gFprFUAZyxqSV.dDZzCidKk4xylmJATrt9c3Dw1p6Umta';
//        $data = "3vd4cMuhb95ZNhbkHlKVh9X5bUYm/K1l9+Oll4FOTOXkMV2X8dOFmI4ZQbRTyCWzeCrvN6/HdefQ5nkom9jZ3A==";
        $key = '$2y$12$noGf.thfl7FbEAGwI63k2udsYQDQBtVOl6y/hmLxQUzHfjbhhB.LG';
        $data = "fZ+vm41fmMyraUXnkAlbh7qi1rq7ohq2MVsi05TBA0ARK6y69NxOH8VwojOUFJtk0/AY+79nl3grDCLsIanY5w==";
        if(empty($data) or empty($key)) throw new SwooleException('请get传data 和 key(encode接口返回数据)');
        $res = decode_aes($data,$key);
        secho('res',$res);
        $this->http_output->end($res);
    }

    public function http_tpl()
    {
        $this->http_output->setHeader('Content-Type', 'text/html; charset=UTF-8');
        if ('GET' === $this->http_input->getRequestMethod()) {
            $data = [
                'name' => 'lee',
                'sex' => 'male'
            ];
            $tpl = $this->loader->view('app::app/oranzh', $data);
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

    public function http_tpl2()
    {
        $this->http_output->setHeader('Content-Type', 'text/html; charset=UTF-8');
        $data = [
            'name' => 'lee',
            'sex' => 'male'
        ];
        $tpl = $this->loader->view('app::app/123', $data);
        $this->http_output->end($tpl);
    }

    public function http_t()
    {
        $data = [
            'user_name' => date('Y-m-d H:i:s'),
            'emails' => 'oranzh.cc@gmail.com',
        ];

        $res = $this->test->dbQueryBuilder->insert('users')->set($data)->query();
        $token = TimerCallBack::addTimer(10,AppModel::class,'timerCallBack',[$res['insert_id'],234]);
        $this->http_output->end($token);
    }

    public function http_oranzh()
    {
        $oranzh = new Oranzh();
        $res = $oranzh->test();
        $this->http_output->end($res);
    }

    public function http_update()
    {
        $all = $this->test->dbQueryBuilder->select('*')->from('ssc')->query();
        $all = $all->getResult()['result'];
//        $num = 0 ;
//        if ($all) {
//            foreach ($all as $v) {
//                $ymd = date('Ymd',$v['create_time']);
//                $this->test->dbQueryBuilder->update('ssc')->set('ymd',$ymd)->where('id',$v['id'])->query();
//                $num += 1;
//            }
//        }
        $this->http_output->end($all);
    }

    public function http_hr()
    {
        $codes = '019&029&089&123&124';
        $count = 5;
        $times = 5;
        $money = 0.5;
        $desc = '[后三直选_单式] 019|029|089|123|124';
        $qishu = date('Ymd',time()).'-055';
        $json = [
            'type' => 'input',
            'methodid' => 11,
            'codes' => $codes,//019&029&089&123&124
            'zip' => 0,
            'nums' => $count,
            'times' => $times,
            'money' => $money,//单位元
            'mode' => 3,
            'point' => 0,
            'desc' => $desc,//[后三直选_单式] 019|029|089|123|124
            'curtimes' => time().rand(100,999)
        ];
        $data = [
            'mainForm' => 'mainForm',
            'lotteryid' => 1,
            'flag' => 'save',
            'lt_sel_times' => 1,
            'lt_sel_modes' => 3,
            'lt_sel_dyprize' => '1940|0',
            'lt_project[]' => json_encode($json),
            'lt_issue_start' => $qishu,//
            'lt_total_nums' => $count,//
            'lt_total_money' => 0.5,//单位元
            'lt_trace_times_margin' => 1,
            'lt_trace_margin' => 50,
            'lt_trace_times_same' => 1,
            'lt_trace_diff' => 1,
            'lt_trace_times_diff' => 2,
            'lt_trace_count_input' => 10,
            'lt_trace_money' => 0
        ];
        $cookie = [
            'JSESSIONID' => 'E68073FA4DB58E5C8FBA21F90C06BF85',
            'modes' => 3,
            'dypoint' => 0
        ];

        $response = $this->hr->httpClient
            ->setMethod('post')
            ->setCookies($cookie)
            ->setData($data)
            ->coroutineExecute('/LotteryService.aspx');
        secho('response',$response);
        $this->http_output->end($response);
    }
}
