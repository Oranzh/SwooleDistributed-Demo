<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/3
 * Time: 10:24
 */

namespace app\Models\wiki;
use Server\CoreBase\Model;

class Ssc extends  Model
{
    protected $ssc;
    protected $test;
    protected $redis;
    protected $table = 'ssc';
    protected $hr;
    public function __construct()
    {
        parent::__construct();
        $this->ssc = get_instance()->getAsynPool("sscquick");
        $this->test = get_instance()->getAsynPool("test");
        $this->redis = get_instance()->getAsynPool("redisPool");
        $this->hr = get_instance()->getAsynPool("hr");
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
    }

    public function api() {
        $res = $this->ssc->httpClient->setQuery([])->coroutineExecute('/newly.do?code=cqssc&rows=30&format=json');
        $res = json_decode($res['body'],true);
        $data = $res['data'];
        $qian = $bai = $shi = $ge = [];
        if($data) {
            foreach ($data as $v) {
                $qian[] = $v['opencode'][2];
                $bai[] = $v['opencode'][4];
                $shi[] = $v['opencode'][6];
                $ge[] = $v['opencode'][8];
            }
        }
        $qian = $this->head8($qian);
        $bai = $this->head8($bai);
        $shi = $this->head8($shi);
        $ge = $this->head8($ge);
        $body = sprintf('千位%s百位%s十位%s个位%s',implode('',$qian),implode('',$bai),implode('',$shi),implode('',$ge));
        //$this->sendEmail($body);
        return [
            $qian,
            $bai,
            $shi,
            $ge,
        ];
    }

    public function api2() {
        $res = $this->ssc->httpClient->setQuery([])->coroutineExecute('/newly.do?code=cqssc&rows=20&format=json');
        $res = json_decode($res['body'],true);
        $data = $res['data'];
        $qian = $bai = $shi = $ge = [];
        if($data) {
            foreach ($data as $v) {
                $qian[] = $v['opencode'][2];
                $bai[] = $v['opencode'][4];
                $shi[] = $v['opencode'][6];
                $ge[] = $v['opencode'][8];
            }
        }
        $qian = $this->head8($qian);
        $bai = $this->head8($bai);
        $shi = $this->head8($shi);
        $ge = $this->head8($ge);
        $body = sprintf('千位%s百位%s十位%s个位%s',implode('',$qian),implode('',$bai),implode('',$shi),implode('',$ge));

        return $body;
    }

    protected function head8($wei)
    {
        $wei = array_count_values($wei);
        arsort($wei);
        $wei = array_keys($wei);
        $wei = array_slice($wei,0,9);
        sort($wei,SORT_NUMERIC );
        return $wei;
    }

    public function sendEmail($body)
    {
        $this->emailConfig = $this->config->get('mailer');
        $transport = (new \Swift_SmtpTransport($this->emailConfig['transport'], $this->emailConfig['port']))
            ->setUsername($this->emailConfig['username'])
            ->setPassword($this->emailConfig['pwd']);
        $mailer = new \Swift_Mailer($transport);
        // Create a message

        $message = (new \Swift_Message('SSC后四复利计划' . date('Y-m-d')))
            ->setFrom(array('admin@oranzh.cc' => '双色球'))
            ->setTo(array('635499475@qq.com'))
            ->setBody($body);
        $mailer->send($message);
    }


    public function all() {
        $res = $this->test->dbQueryBuilder->select("*")->from($this->table)->query();
        return $res->getResult();
    }

    public function records()
    {
        $sql = 'select sum(bet) as m , sum(profit)  as n from  '.$this->table.' where  create_time between  '.mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time())) .' and '.mktime(23,59,59,date('m',time()),date('d',time()),date('Y',time()));
        $bet_today = $this->test->dbQueryBuilder->query($sql);
        return $bet_today->getResult();
    }

    public function day()
    {
        $sql = "select ymd , DATE_FORMAT(ymd,'%W')  as  Week,sum(bet) as m ,sum(profit) as n from ssc  group by ymd ORDER BY create_time desc";
        $res = $this->test->dbQueryBuilder->query($sql);
        return $res->getResult();
    }

    public function shouyi()
    {
        $ymd = date('Ymd',time());
        $sql = "select ymd,sum(bet) as m ,sum(profit) as n from ssc  WHERE ymd = $ymd";
        $res = $this->test->dbQueryBuilder->query($sql);
        $res = $res->result_array();
        $res = $res[0]['n'] - $res[0]['m'];
        return $res;
    }

    public function ynvi()
    {
        $ymd = date('Ymd',time());
        $sql = "select ymd,`expect`,opencode,status,bet,profit from ssc  WHERE ymd = '$ymd' ORDER BY create_time DESC ";
        $res = $this->test->dbQueryBuilder->query($sql);
        $res = $res->result_array();
        return $res;
    }

    public function hr($codes,$money,$qishu,$times) {
		$money = 1;
		$qishu = '20180425-102';
        $count = count($codes);
        $tmp = $codes;
        $codes = implode('&',$codes);
        $desc = '[后三直选_单式] ';
        $desc .= implode('|',$tmp);
        $desc = substr($desc,0,57).'...';
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
            'lt_total_money' => $money,//单位元
            'lt_trace_times_margin' => 1,
            'lt_trace_margin' => 50,
            'lt_trace_times_same' => 1,
            'lt_trace_diff' => 1,
            'lt_trace_times_diff' => 2,
            'lt_trace_count_input' => 10,
            'lt_trace_money' => 0
        ];
        $cookie = [
            'JSESSIONID' =>'A4697E6E4EB6AA284F6DA890E7D8413A',
            'modes' => 3,
            'dypoint' => 0
        ];

        $response = $this->hr->httpClient
            ->setMethod('post')
            ->setCookies($cookie)
            ->setData($data)
            ->coroutineExecute('/LotteryService.aspx');
        secho('response',$response);
        return $response;
    }


}

