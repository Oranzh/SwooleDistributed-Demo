<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/3
 * Time: 10:24
 */

namespace app\Models\wiki;
use Server\CoreBase\Model;

class Ssc extends  Model
{
    protected $ssc;
    protected $test;
    protected $redis;
    protected $table = 'ssc';
    public function __construct()
    {
        parent::__construct();
        $this->ssc = get_instance()->getAsynPool("ssc");
        $this->test = get_instance()->getAsynPool("test");
        $this->redis = get_instance()->getAsynPool("redisPool");
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
        if ($this->test != null) {
            $this->installMysqlPool($this->test);
        }
    }

    public function api() {
        $res = $this->ssc->httpClient->setQuery([])->coroutineExecute('/cqssc-10.json');
        $res = json_decode($res['body'],true);
        $data = $res['data'];
        sleepCoroutine(3000);
        $res2 = $this->ssc->httpClient->setQuery([])->coroutineExecute('/cqssc-20.json');
        $res2 = json_decode($res2['body'],true);
        $data2 = $res2['data'];

        $opencode = '';
        $mahe = '';
        $bai = $shi = $ge = [];
        if($data) {
            foreach ($data as &$v) {
                $v['code'] = explode(',',substr($v['opencode'],-5));
                $mahe .= ($v['code'][0] + $v['code'][1])%10 . ',';
                $mahe .= ($v['code'][0] + $v['code'][2])%10 . ',';
                $mahe .= ($v['code'][2] + $v['code'][1])%10 . ',';
                $v['opencode'] = substr($v['opencode'], -6);
                $opencode .= $v['opencode'];
            }
            UNSET($v);
        }
        if($data2) {
            foreach ($data2 as $v) {
                $bai[] = $v['opencode'][4];
                $shi[] = $v['opencode'][6];
                $ge[] = $v['opencode'][8];
            }
        }
        $bai = $this->head8($bai);
        $shi = $this->head8($shi);
        $ge = $this->head8($ge);
        $opencode = ltrim($opencode,',');
        $opencode = explode(',',$opencode);
        $opencode = array_count_values($opencode);
        arsort($opencode);
        $mahe = rtrim($mahe,',');
        $mahe = explode(',',$mahe);
        $mahe = array_count_values($mahe);
        arsort($mahe);
        $opencode = array_keys($opencode);
        $mahe = array_keys($mahe);
        if (count($mahe) < 10) {
            $tmp = range(0,9);
            foreach ($tmp as $v) {
                if (in_array($v,$mahe)) continue;
                else array_push($mahe,$v);
            }
        }
        if (count($opencode) < 10) {
            $tmp = range(0,9);
            foreach ($tmp as $v) {
                if (in_array($v,$mahe)) continue;
                else array_push($opencode,$v);
            }
        }
        $opencode = array_slice($opencode,0,5);
        $mahe = array_slice($mahe,0,5);
        $res = $this->math($opencode,$mahe,$bai,$shi,$ge);
        $count = count($res);

        $kaijiang = $data[0];
        $redis_ssc = $this->redis->getCoroutine()->get('ssc');
        $redis_ssc = json_decode($redis_ssc,true);
        $kaijiang['opencode'] = $kaijiang['opencode'][1].$kaijiang['opencode'][3].$kaijiang['opencode'][5] * 1;
        if (in_array($kaijiang['opencode'],$redis_ssc)) {
            //处理中奖逻辑,并且复利
            $times = $this->redis->getCoroutine()->get('times');
            $profit = 1950 * $times;
            if ($times == 3) {
                $times = 4;
            } else {
                $times = 3;
            }
            $this->test->dbQueryBuilder->update($this->table)
                ->set('status',1)
                ->set('profit',$profit)
                ->where('expect', $kaijiang['expect'])->query();
        } else {
            //重新开始
            $times = 3;
        }
        //更新开奖号
        $this->test->dbQueryBuilder->update($this->table)
            ->set('opencode',$kaijiang['opencode'])
            ->where('expect', $kaijiang['expect'])->query();
        //计算下一期期号
        if (substr($kaijiang['expect'],-3) == '120') {
            $expect = date('Ymd',strtotime("+1 day")).'001';
        } else {
            $expect = $kaijiang['expect'] + 1;
        }
        //写入购买记录
        $insert = [
            'expect' => $expect,
            'count' => $count,
            'bet' => $count * $times * 2,
            'danma' => implode(',',$opencode),
            'mahe' => implode(',',$mahe),
            'bai' => json_encode($bai),
            'shi' => json_encode($shi),
            'ge' => json_encode($ge),
            'profit' => 0 ,
            'status' => 0 ,
            'create_time' => time()
        ];
        $this->test->dbQueryBuilder->insert($this->table)->set($insert)->query();
        //写入缓存
        $this->redis->getCoroutine()->set('ssc',json_encode($res));
        $this->redis->getCoroutine()->set('times',$times);
        return $res;
    }

    protected function head8($wei)
    {
        $wei = array_count_values($wei);
        arsort($wei);
        $wei = array_keys($wei);
        $wei = array_slice($wei,0,8);
        return $wei;
    }
    /**
     * @param $opencode  胆组
     * @param $mahe   码合
     * @return array  组合号码
     */
    public function math($opencode,$mahe,$bai,$shi,$ge)
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
            $mahe_tmp_0 = $item[0] + $item[1];
            $mahe_tmp_0 = $mahe_tmp_0 % 10;
            $mahe_tmp_1 = $item[0] + $item[2];
            $mahe_tmp_1 = $mahe_tmp_1 % 10;
            $mahe_tmp_2 = $item[1] + $item[2];
            $mahe_tmp_2 = $mahe_tmp_2 % 10;
            /**
             * 码合,不做此判断,错误率太高

            $num = 0 ;
            if (in_array($mahe_tmp_0,$mahe_01)) $num += 1;
            if (in_array($mahe_tmp_1,$mahe_01)) $num += 1;
            if (in_array($mahe_tmp_2,$mahe_01)) $num += 1;
             */
            $num = 0 ;
            if (in_array($item[0],$bai)) $num += 1;
            if (in_array($item[1],$shi)) $num += 1;
            if (in_array($item[2],$ge)) $num += 1;

            //判断胆码组和两码合
            if ((in_array($item[0],$opencode) or in_array($item[1],$opencode) or in_array($item[2],$opencode)) and (in_array($mahe_tmp_0,$mahe) or in_array($mahe_tmp_1,$mahe) or in_array($mahe_tmp_2,$mahe)) and $num >=2 ) $res[] = $item;
            else continue;
        }
        UNSET($item);
        return $res;

    }

    public function all() {
        $res = $this->test->dbQueryBuilder->select("*")->from($this->table)->query();
        return $res->getResult();
    }

    public function records()
    {
        $sql = 'select sum(bet) as m , sum(profit)  as n from  '.$this->table.' where  create_time between  '.mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time())) .' and '.mktime(23,59,59,date('m',time()),date('d',time()),date('Y',time()));
        $bet_today = $this->test->dbQueryBuilder->query($sql);
        return $bet_today->getResult();
    }

}

