<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/10
 * Time: 16:54
 */

namespace app\Controllers\wiki;

use app\Exception\BlueWarningException;
use app\Tasks\AppTask;
use Server\Asyn\HttpClient\HttpClientRequestCoroutine;
use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;
use app\Controllers\BaseController;

class Api extends BaseController
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

    public function put2()
    {
        $this->xluob = get_instance()->getAsynPool("xluob");
//        $data = $this->http_input->getAllPostGet();
//        if (empty($data['url'])) throw new BlueWarningException('url参数必须传,例如/radish/index/index');
//        $url = $data['url'];
//        UNSET($data['url']);
//        if (empty($data)) {
//            $data = '';
//        } else {
//
//            $data = msgpack_pack($data);
//        }
        $url = '/radish/reword/pay';
        $data = [
            'id' => 268477399,
            'pay' => 4,
            '_t' => 'sC8Lcol8s3anoKqoV3\/X0dIJ\/WG12Yzx9wtD1J7e0ersQ0bwDoaeO8r5oNM6TLq2A\/Sihr0bMg9fqU4PdgCgOnqw8QwJ8JzT5ZcdT1NAmrFK3zT\/er+TTfHJwK7KM3151ng8vKM4waYhLaqOs+9D4Ep5KT\/nNz0Wsz7BMwpoeoH9QabgGptEKMpLlnncCkRJ',
            'title' => 'null',
            'price' => 'null',
            'jh_orderid' => 'null',
            'alipay' => 'null',
            'money' => 'null',
            'type' => 0,
            'orderId' => null,
            'info' => null,
        ];
        $data = msgpack_pack($data);
        $response = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDowngrade(function () {
                    throw new BlueWarningException('请勿频繁请求');
                });
            });
        if ($response['statusCode'] != 200) throw new BlueWarningException('请求失败,请检查接口地址是否正确');
        $response = msgpack_unpack($response['body']);
        $this->http_output->end($response,false);
    }
    public function http_put() {
        for($i = 0;$i<=10;$i++) {
            $this->put2();
        }
        $this->end('ok');
    }

    public function http_put3()
    {
        $this->xluob = get_instance()->getAsynPool("xluob");
//        $data = $this->http_input->getAllPostGet();
//        if (empty($data['url'])) throw new BlueWarningException('url参数必须传,例如/radish/index/index');
//        $url = $data['url'];
//        UNSET($data['url']);
//        if (empty($data)) {
//            $data = '';
//        } else {
//
//            $data = msgpack_pack($data);
//        }
        $url = '/radish/passport/login';
        $data = [
            'phone' => 15249232349,
            'password' => 123123,
        ];
        $data = msgpack_pack($data);
        $response = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDowngrade(function () {
                    throw new BlueWarningException('请勿频繁请求');
                });
            });
        var_dump($response);
        if ($response['statusCode'] != 200) throw new BlueWarningException('请求失败,请检查接口地址是否正确');
        $response = msgpack_unpack($response['body']);
        $this->http_output->end($response,false);
    }

    public function http_task()
    {
        $xluob = get_instance()->getAsynPool("xluob2");
        $task = $this->loader->task(AppTask::class);
        for ($i = 0 ; $i <= 10 ; $i++) {
            $task->put($xluob);
        }
    }

    public function http_putt()
    {
        $this->xluob = get_instance()->getAsynPool("xluob");
        $url = '/radish/reword/pay';
        $data = [
            'id' => 268482055,
            'pay' => 4,
            '_t' => 'sC8Lcol8s3anoKqoV3\/X0dIJ\/WG12Yzx9wtD1J7e0ersQ0bwDoaeO8r5oNM6TLq2A\/Sihr0bMg9fqU4PdgCgOnqw8QwJ8JzT5ZcdT1NAmrFK3zT\/er+TTfHJwK7KM3151ng8vKM4waYhLaqOs+9D4Ep5KT\/nNz0Wsz7BMwpoeoG39qOJ2ftX+\/qNdtWL44eq',
            'title' => 'null',
            'price' => 'null',
            'jh_orderid' => 'null',
            'alipay' => 'null',
            'money' => 'null',
            'type' => 0,
            'orderId' => null,
            'info' => null,
        ];
        $data = msgpack_pack($data);
        $response1 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
        $response2 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
        $response3 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
        $response4 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
        $response5 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
        $response6 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
		$res1 = msgpack_unpack($response1->recv()['body']);
        $res2 = msgpack_unpack($response2->recv()['body']);
        $res3 = msgpack_unpack($response3->recv()['body']);
        $res4 = msgpack_unpack($response4->recv()['body']);
        $res5 = msgpack_unpack($response5->recv()['body']);
        $res6 = msgpack_unpack($response6->recv()['body']);
		$res = [
            $res1,
            $res2,
            $res3,
            $res4,
            $res5,
            $res6,
		];
        $this->http_output->end($res,false);
    }


    public function http_createq()
    {
        $this->xluob = get_instance()->getAsynPool("xluob");
        $url = '/radish/question/create';
        $data = [
            's_id' => 268479959,
            'latitude' => 0,
            '_t' => 'sC8Lcol8s3anoKqoV3\/X0dIJ\/WG12Yzx9wtD1J7e0ersQ0bwDoaeO8r5oNM6TLq2A\/Sihr0bMg9fqU4PdgCgOnqw8QwJ8JzT5ZcdT1NAmrFK3zT\/er+TTfHJwK7KM3151ng8vKM4waYhLaqOs+9D4Ep5KT\/nNz0Wsz7BMwpoeoG39qOJ2ftX+\/qNdtWL44eq',
            'name' => 'nihao',
            'content' => 'fdskajfkl',
            'code' => '120200',
            'site_two' => 'hahah',
            'phone' => 13456454565,
            'f_g_id' => 2,
            'g_id' => 96,
            'assoc_id' => 123,
        ];
        $data = msgpack_pack($data);
        $response1 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
        $response2 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });
        $response3 = $this->xluob->httpClient
            ->setMethod('PUT')
            ->setData($data)
            ->coroutineExecute($url,function (HttpClientRequestCoroutine $httpClientRequestCoroutine){
                $httpClientRequestCoroutine->setDelayRecv();
            });

        $res1 = msgpack_unpack($response1->recv()['body']);
        $res2 = msgpack_unpack($response2->recv()['body']);
        $res3 = msgpack_unpack($response3->recv()['body']);
        $res = [
            $res1,
            $res2,
            $res3,
        ];
        $this->http_output->end($res,false);
    }

}
