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
use app\Controllers\bus\Post;

class Art extends BaseController
{

    protected $post;

    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->post = $this->loader->model(Post::class,$this);
    }

    public function http_create()
    {
       $user = $this->getLogined();
       $type = $this->http_input->post('type') ?? null;
       $content = $this->http_input->post('content') ?? null;
       if (is_null($post) or is_null($type)) throw  new BlueWarningException('发布错误,请检查参数是否完整');
       $data = [];
       $data['user_id'] = $user['id'];
       $data['content'] = $content;
       $data['type'] = $type;
       $data['create_time'] = time();
       $id = $this->post->insert($data);
       $res = [
           'id' => $id,
           'token' => $this->getToken()
       ];

       $this->end($res);


    }

    public function http_update()
    {
        $info = $this->getLogined();
        $avatar = $this->http_input->post('avatar');
        $nickname = $this->http_input->post('nickname');
        $data = [];
        if (empty($avatar) and empty($nickname))  $this->end('更新失败',1);
        if ($avatar) $data['avatar'] = $avatar;
        if ($nickname) $data['nickname'] = $nickname;
        $data['update_time'] = time();
        $this->user->update($data,$info['id']);
        $this->end('更新成功');
    }

    public function http_echo()
    {
        $this->end(123);
    }
}
