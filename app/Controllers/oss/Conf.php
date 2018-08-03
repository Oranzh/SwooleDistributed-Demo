<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/3
 * Time: 9:30
 */

namespace app\Controllers\oss;
use app\Controllers\BaseController;
use Server\CoreBase\ChildProxy;

class Conf extends BaseController
{
    protected $ali;
    protected $ossConf;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->ali = get_instance()->getAsynPool('alicdn');
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->setConfig();
    }
    public function http_perform()
    {
        $id = $this->ossConf['ak'];
        $key = $this->ossConf['sk'];
        $host = sprintf('http://%s.%s',$this->ossConf['bucket'],$this->ossConf['url']);
        //$host = 'http://mahuateng.oss-cn-beijing.aliyuncs.com';
        $callbackUrl = $this->ossConf['callback'];
        $callback_param = array('callbackUrl' => $callbackUrl,
            'callbackBody' => 'filename=${object}&size=${size}&mimeType=${mimeType}&height=${imageInfo.height}&width=${imageInfo.width}',
            'callbackBodyType' => "application/x-www-form-urlencoded");
        $callback_string = json_encode($callback_param);
        $base64_callback_body = base64_encode($callback_string);
        $now = time();
        $expire = 30; //设置该policy超时时间是10s. 即这个policy过了这个有效时间，将不能访问
        $end = $now + $expire;
        $expiration = $this->gmt_iso8601($end);
        $dir = $this->ossConf['ns'].'/'.$this->ossConf['path'].'/';
        //最大文件大小.用户可以自己设置
        $condition = array(0 => 'content-length-range', 1 => 0, 2 => 1048576000);
        $conditions[] = $condition;

        //表示用户上传的数据,必须是以$dir开始, 不然上传会失败,这一步不是必须项,只是为了安全起见,防止用户通过policy上传到别人的目录
        $start = array(0 => 'starts-with', 1 => '$key', 2 => $dir);
        $conditions[] = $start;
        $arr = array('expiration' => $expiration, 'conditions' => $conditions);
        $policy = json_encode($arr);
        $base64_policy = base64_encode($policy);
        $string_to_sign = $base64_policy;
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $key, true));

        $response = array();
        $response['accessid'] = $id;
        $response['host'] = $host;
        $response['policy'] = $base64_policy;
        $response['signature'] = $signature;
        $response['expire'] = $end;
        $response['callback'] = $base64_callback_body;
        //这个参数是设置用户上传指定的前缀
        $response['dir'] = $dir;
        $this->end($response);

    }

    protected function gmt_iso8601($time)
    {
        $dtStr = date("c", $time);
        $mydatetime = new \DateTime($dtStr);
        $expiration = $mydatetime->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration . "Z";
    }

    public function http_callback()
    {
        // 1.获取OSS的签名header和公钥url header
        $authorizationBase64 = "";
        $pubKeyUrlBase64 = "";
        /*
         * 注意：如果要使用HTTP_AUTHORIZATION头，你需要先在apache或者nginx中设置rewrite，以apache为例，修改
         * 配置文件/etc/httpd/conf/httpd.conf(以你的apache安装路径为准)，在DirectoryIndex index.php这行下面增加以下两行
            RewriteEngine On
            RewriteRule .* - [env=HTTP_AUTHORIZATION:%{HTTP:Authorization},last]
         * */
        if ($this->http_input->header('authorization') != null) {
            $authorizationBase64 = $this->http_input->header('authorization');
        }
        if ($this->http_input->header('x-oss-pub-key-url') != null) {
            $pubKeyUrlBase64 = $this->http_input->header('x-oss-pub-key-url');
        }
        if ($authorizationBase64 == '' || $pubKeyUrlBase64 == '') {
            $this->http_output->setStatusHeader(403);
            $this->interrupt();
        }

// 2.获取OSS的签名
        $authorization = base64_decode($authorizationBase64);

// 3.获取公钥
        $pubKeyUrl = base64_decode($pubKeyUrlBase64);
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $pubKeyUrl);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
//        $pubKey = curl_exec($ch);
        $pubKey = $this->alipub();
// 4.获取回调body
        $body = $this->http_input->getRawContent();
        // filename=oss_test%2Fpexels-photo-175773.jpeg&size=5910146&mimeType=image%2Fjpeg&height=3744&width=5616
        parse_str(urldecode($body),$output);
        $url = $this->getUrl($output['filename']);


// 5.拼接待签名字符串
        $path = $this->http_input->getRequestUri();
        $pos = strpos($path, '?');
        if ($pos === false) {
            $authStr = urldecode($path) . "\n" . $body;
        } else {
            $authStr = urldecode(substr($path, 0, $pos)) . substr($path, $pos, strlen($path) - $pos) . "\n" . $body;
        }

// 6.验证签名
        $ok = openssl_verify($authStr, $authorization, $pubKey, OPENSSL_ALGO_MD5);
        if ($ok == 1) {
            $data = [
                'url' => $url
            ];
            $data = json_encode($data);
            $this->end($data,0,false);
        } else {
            $this->http_output->setStatusHeader(403);
            $this->interrupt();
        }
    }

    public function getUrl($url)
    {
        if (empty($url)) return '';
        return $this->ossConf['cdn'].'/'.$url;
    }

    public function setConfig()
    {
         $this->ossConf = $this->config->get('oss');
    }

    public function alipub()
    {
        $response = $this->ali->httpClient
            ->setMethod('GET')
            ->coroutineExecute('/callback_pub_key_v1.pem');
        return $response['body'];
    }
}
