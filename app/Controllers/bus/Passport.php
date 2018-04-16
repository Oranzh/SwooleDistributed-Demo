<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/10
 * Time: 16:54
 */

namespace app\Controllers\bus;

use Server\Asyn\HttpClient\HttpClientRequestCoroutine;
use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;
use Server\CoreBase\SwooleException;
use app\Models\bus\User;

class Passport extends Controller
{

    private $pub_key = 'JKLDJFIHKJ4456848@#$adf';
    private $user;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->user = $this->loader->model(User::class,$this);
    }

    public function http_login()
    {
        $phone = $this->http_input->get('phone');
        if (!preg_match('/^1[3-9]{1}[0-9]{9}$/', $phone)) {
            $res = [
                'msg' => '手机号不正确',
                'flag' => 1
            ];
            $this->http_output->end($res);
        }
        $passwd = $this->http_input->get('passwd');
        $tmp_user = $this->user->getOneByPhone($phone);

        if (empty($tmp_user)) {
            //录入用户
            $passwd = $this->user->passwd($passwd);
            $data = [
                'phone' => $phone,
                'passwd' => $passwd,//加密后的密码
                'create_time' => time()
            ];
            $id = $this->user->insert($data);
            $token = [
                'id' => $id,
                'phone' => $phone,
            ];
        } else {
            $tmp_user = $tmp_user[0];
            $passwd = $this->http_input->get('passwd');
            secho('tmpuser',$tmp_user);
            if (!$this->user->validatePasswd($passwd,$tmp_user['passwd'])) {
                $res = [
                    'msg' => '密码不正确',
                    'flag' => 1
                ];
                $this->http_output->end($res);
                $this->interrupt();
            }
            $token = [
                'id' => $tmp_user['id'],
                'phone' => $tmp_user['phone']
            ];
            $id = $tmp_user['id'];
        }

        $token = encode_aes($token,$this->pub_key,true);
        $res = [
            'token' => $token,
            'user' => [
                'id' => $id,
                'phone' => $phone,
            ],
            'flag' => 0,
        ];
        $this->http_output->end($res);
    }

    public function http_update()
    {

    }
}
