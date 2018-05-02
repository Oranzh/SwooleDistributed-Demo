<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/10
 * Time: 16:54
 */

namespace app\Controllers\wiki;

use app\Exception\BlueWarningException;
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

    public function http_put()
    {
        $data = $this->http_input->getAllPostGet();
        if (empty($data['url'])) throw new BlueWarningException('url参数必须传,例如/radish/index/index');
        $url = $data['url'];
        UNSET($data['url']);
        if (empty($data)) {
            $data = '';
        } else {

            $data = msgpack_pack($data);
        }
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

}
