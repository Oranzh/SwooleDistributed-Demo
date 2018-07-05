<?php
namespace app\Tasks;

use app\Exception\BlueWarningException;
use Server\CoreBase\Task;
use Server\Start;

/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午1:06
 */
class AppTask extends Task
{
    protected $xluob;
    public function testTask()
    {
		if(Start::isLeader()) {
			secho('appTask','ok');
			//return "test task\n";
		}
    }
    public function err() {
        throw new BlueWarningException('hahahhahahahhahahahhahahha');
    }

    public function put($xluob)
    {
        $this->xluob = $xluob;
        $url = '/radish/reword/pay';
        $data = [
            'id' =>  268484023,
            'pay' => 4,
            '_t' => 'sC8Lcol8s3anoKqoV3\/X0W6E8dG0F+cLWARFMI+C5YXEI7nHn\/pqtd4kSKEO7hJKgPHMSqfJN+mlwfro5OggqEBZV\/awwBNjGzRWWgLyH9PGhow7SOd7mOyomy43UfLj98RwgzqeulzasFUZINH28HHeIwucqG50NujCLXVb\/dcZGHbdOqa7GdzCyM8503DX',
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
            ->coroutineExecute($url);
        if ($response['statusCode'] != 200) throw new BlueWarningException('请求失败,请检查接口地址是否正确');
        $response = msgpack_unpack($response['body']);
        $this->http_output->end($response,false);
    }

}
