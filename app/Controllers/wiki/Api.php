<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/10
 * Time: 16:54
 */

namespace app\Controllers\wiki;

use Server\Asyn\HttpClient\HttpClientRequestCoroutine;
use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;

class Api extends Controller
{

    private $xluob;
    private $hr;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->xluob = get_instance()->getAsynPool("xluob");
        $this->hr = get_instance()->getAsynPool("hr");
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function http_put()
    {
        $data = [
            'phone' => 15249232349,
            'password' => 123456
		];
        $data = msgpack_pack($data);
        $response = $this->xluob->httpClient
            ->setMethod('put')
            ->setData($data)
            ->coroutineExecute('/radish/passport/login',function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDowngrade(function () {
                    $this->http_output->end('This is setDownGrade function!');
                });
            });
        $response = msgpack_unpack($response['body']);
        $this->http_output->end($response,false);
    }

    public function http_post()
    {
        $data = [
            'q_id' => 268477823,
            'to_id' => 0,
            'type' => 0,
            'content' => 'token123456'
        ];
        $tmp = '3vO1XOrRzt8DJ6TnugoEiD3UL6Ndn7TDSfb9KZxArqEHZZVo1xazMcGjC5lSHCOmVY4UBTYKrjYhO31z4MBByNm0gDabkGEp0jAD3btv78ue0DVV7sh5RBEuLTtqCD%2F1WJpwwZBjHLR%2FqUvBi7oZ7o52JDfI1%2F18IdSNyt14vxo%3D';
        $tmp = urldecode($tmp);
        $token = ['_BUSS' => $tmp];
        $response = $this->xluob->httpClient
            ->setMethod('post')
            ->setCookies($token)
            ->setData($data)
            ->coroutineExecute('/radishweb/comments/create');
        $this->http_output->end(json_decode($response['body'],true));
    }

    public function http_hr()
    {
        $codes = '019&029&089&123&124';
        $count = 5;
        $times = 5;
        $money = 0.5;
        $desc = '[后三直选_单式] 019|029|089|123|124';
        $qishu = date('Ymd',time()).'-048'.;
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
        $this->http_output->end($response));
    }
}
