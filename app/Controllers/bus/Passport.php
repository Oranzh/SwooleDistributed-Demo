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

    private $xluob;
    private $pub_key = '';
    private $user;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->xluob = get_instance()->getAsynPool("xluob");
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
            throw new SwooleException('invalid');
        }
        $tmp_user = $this->user->getOneByPhone($phone);
        if (empty($tmp_user)) {
            //录入用户
            $data = [
                'phone' => $phone,
                'passwd' => $passwd,//加密后的密码
                'avatar' => '',
            ];
            $this->user->insert($data);
        }

        $this->http_output->end($res);
    }
}
