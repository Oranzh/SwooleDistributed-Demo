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
use app\Exception\BlueWarningException;
use Server\CoreBase\ChildProxy;

class Passport extends BaseController
{

    private $pub_key = 'JKLDJFIHKJ4456848@#$adf';
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function http_login()
    {
        $phone = $this->http_input->getPost('phone');
        if (!preg_match('/^1[3-9]{1}[0-9]{9}$/', $phone)) {
            throw new BlueWarningException('手机号不正确');
        }
        $passwd = $this->http_input->getPost('passwd');
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
                'time' => time(),
                'expire' => 30
            ];
        } else {
            $passwd = $this->http_input->get('passwd');
            if (!$this->user->validatePasswd($passwd,$tmp_user['passwd'])) {
                throw new BlueWarningException('密码不正确');
            }
            $token = [
                'id' => $tmp_user['id'],
                'phone' => $tmp_user['phone'],
                'time' => time(),
                'expire' => 30
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
        $info = $this->getLogined();
        $avatar = $this->http_input->getPost('avatar');
        $nickname = $this->http_input->getPost('nickname');
        $data = [];
        if ($avatar) $data['avatar'] = $avatar;
        if ($nickname) $data['nickname'] = $nickname;
        $this->user->update($data,$info['id']);
        $this->end('更新成功');
    }

    public function http_t()
    {
        $id = $this->http_input->get('id');
        $res = $this->user->getOneById($id);
        $this->end($res);

    }
}
