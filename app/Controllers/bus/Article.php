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
use app\Models\bus\Post;

class  Article extends BaseController
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
       $type = $this->http_input->getPost('type') ?? null;
       $content = $this->http_input->getPost('content') ?? null;
       if (is_null($content) or is_null($type)) throw  new BlueWarningException('发布错误,请检查参数是否完整');
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


    /**
     * 更新帖子状态,不可逆
     */
    public function http_status()
    {
        $user = $this->getLogined();
        $status = $this->http_input->getPost('status');
        $id = $this->http_input->getPost('id');
        $this->post->status($id,$status,$user['id']);
        $this->end('状态修改成功');
	}
}
