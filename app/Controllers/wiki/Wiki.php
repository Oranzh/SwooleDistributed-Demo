<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/3/30
 * Time: 17:37
 */

namespace app\Controllers\wiki;


use app\Models\wiki\Ssc;
use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;
use Server\CoreBase\SwooleException;

class Wiki extends Controller
{

    protected $redis1;
    protected $mysql;
    protected $weixin;
    protected $test;
    protected $oss;
    protected $ssc;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->test = get_instance()->getAsynPool("test");
        $this->ssc = get_instance()->getAsynPool("ssc");
    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        if ($this->test != null) {
            $this->installMysqlPool($this->test);
        }
    }

    public function http_memory()
    {
        echo memory_get_usage() . "\n";
        $a = str_repeat("Hello", 4242);
        echo memory_get_usage() . "\n";
        unset($a);
        echo memory_get_usage() . "\n";
        $this->http_output->end(memory_get_usage());
    }

    public function http_tpl()
    {
        $this->http_output->setHeader('Content-Type', 'text/html; charset=UTF-8');
        if ('GET' === $this->http_input->getRequestMethod()) {
            $data = [
                'name' => 'lee',
                'sex' => 'male'
            ];
            $tpl = $this->loader->view('app::wiki/page/user/detail/main', $data);
            $this->http_output->end($tpl);
        }
        $name = $this->http_input->getPost('name');
        $emails = $this->http_input->getPost('emails');
        $data = [
            'user_name' => $name,
            'emails' => $emails,
        ];
        $res = $this->db->insert('users')->set($data)->query();
        $res = $res->getResult();
        $this->http_output->end($res);

    }

    public function http_api() {
        $res = $this->ssc->httpClient->setQuery([])->coroutineExecute('/cqssc-30.json');
        $res = json_decode($res['body'],true);
        $data = $res['data'];
        $bai = $shi = $ge = [];
        if ($data) {
            foreach ($data as $v) {
                $bai[] = $v['opencode'][4];
                $shi[] = $v['opencode'][6];
                $ge[] = $v['opencode'][8];
            }
        }
        $bai = $this->head8($bai);
        $shi = $this->head8($shi);
        $ge = $this->head8($ge);
        secho('bai',$bai);
        secho('shi',$shi);
        secho('ge',$ge);
        $res = [];
        $range = range(000,999);
        foreach ($range as &$item) {
            //不足3位,补全3位
            if ($item < 100) {
                $item = str_pad($item, 3, '0', STR_PAD_LEFT);
            } else {
                $item = $item . ''; //强制转换类型
            }
            $num = 0 ;
            if (in_array($item[0],$bai)) $num += 1;
            if (in_array($item[1],$shi)) $num += 1;
            if (in_array($item[2],$ge)) $num += 1;
            if ($num >= 2) $res[] = $item;
            else continue;
        }
        $this->http_output->end($res);
    }

    protected function head8($wei)
    {
        $wei = array_count_values($wei);
        arsort($wei);
        $wei = array_keys($wei);
        $wei = array_slice($wei,0,8);
        return $wei;
    }

    /*
     * 测试钉钉机器人日志,请勿一直请求
     */
    public function http_throw()
    {
        $this->http_output()->end(123);
    }

    /**
     * @param $opencode  胆组
     * @param $mahe   码合
     * @return array  组合号码
     */
    public function math($opencode,$mahe,$mahe_01)
    {
        $res = [];
        $range = range(000,999);
        foreach ($range as &$item) {
            //不足3位,补全3位
            if ($item < 100) {
                $item = str_pad($item,3,'0',STR_PAD_LEFT);
            } else {
                $item = $item . ''; //强制转换类型
            }
            //码合
            $mahe_tmp_0 = $item[0] + $item[1];
            $mahe_tmp_0 = $mahe_tmp_0 % 10;
            $mahe_tmp_1 = $item[0] + $item[2];
            $mahe_tmp_1 = $mahe_tmp_1 % 10;
            $mahe_tmp_2 = $item[1] + $item[2];
            $mahe_tmp_2 = $mahe_tmp_2 % 10;
            $num = 0 ;
            if (in_array($mahe_tmp_0,$mahe_01)) $num += 1;
            if (in_array($mahe_tmp_1,$mahe_01)) $num += 1;
            if (in_array($mahe_tmp_2,$mahe_01)) $num += 1;
            //判断胆码组和两码合
            if ((in_array($item[0],$opencode) or in_array($item[1],$opencode) or in_array($item[2],$opencode)) and (in_array($mahe_tmp_0,$mahe) or in_array($mahe_tmp_1,$mahe) or in_array($mahe_tmp_2,$mahe)) and $num <= 1 ) $res[] = $item;
            else continue;
        }
        UNSET($item);
        return $res;

    }

    public function http_pad()
    {
        $response = $this->ssc->httpClient->setQuery([])->coroutineExecute('/cqssc-10.json');
        $res = json_decode($response['body'],true);
        $this->http_output->end($res['data']);
    }

    public function http_ssc()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->all();
        if($res['result']) {
            foreach($res['result'] as &$v) $v['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            UNSET($v);
        }
        $this->http_output->end($res);
    }

    public function http_create()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->api();
        $this->http_output->end($res);
    }

    public function http_record()
    {
        $ssc = $this->loader->model(Ssc::class,$this);
        $res = $ssc->records();
        $this->http_output->end($res);
    }

    public function http_smarty()
    {
        $smarty = new \Smarty();
        secho('smarty',$smarty->ds);
        $this->http_output->end($smarty->ds);
    }

}
