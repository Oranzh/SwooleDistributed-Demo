<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/3
 * Time: 16:59
 */

namespace app\Controllers\wss;



use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;

class Send extends Controller
{
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);

    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    public function perform()
    {
        $uid = 'websocket_'.$this->client_data->uid;
        $content = $this->client_data->content;
        if ($this->client_data->uid == 'all') {
            $this->sendToAll($content);
        } elseif($this->client_data->to == 'two'){//给1个人以上发消息
            $uid = explode(',',$uid);
            $uid = array_map(function ($v){
                return 'websocket_'.$v;
            },$uid);
            $this->sendToUids($uid,$content);
        } else {
            $data = [
                'from' => $this->uid,
                'to' => $uid,
                'message' => $content,
                'time' => time(),
            ];
            $tmp = [$this->uid,$uid];
            sort($tmp);
            $key = implode('-',$tmp);
            $this->redis->sAdd($key,json_encode($data));
            $this->sendToUid($uid,$content);
        }
    }
}
