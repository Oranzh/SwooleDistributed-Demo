<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/10
 * Time: 16:54
 */

namespace app\Controllers\bus;

use app\BlueException;
use app\Controllers\BaseController;
use Server\CoreBase\ChildProxy;
use app\Models\bus\User;

class Passport extends BaseController
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
            $this->end('手机号不正确',1);
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
                'time' => time()
            ];
        } else {
            $tmp_user = $tmp_user[0];
            $passwd = $this->http_input->get('passwd');
            if (!$this->user->validatePasswd($passwd,$tmp_user['passwd'])) {
                $this->end('密码不正确',1);
            }
            $token = [
                'id' => $tmp_user['id'],
                'phone' => $tmp_user['phone'],
                'time' => time()
            ];
            $id = $tmp_user['id'];
        }

        $token = encode_aes($token,$this->pub_key,true);
        $res = [
            'token' => $token,
            'user' => [
                'id' => $id,
                'phone' => $phone,
            ]
        ];
        $this->end($res);
    }

    public function http_update()
    {

    }
}
