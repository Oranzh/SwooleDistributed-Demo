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
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->xluob = get_instance()->getAsynPool("xluob");
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
}
