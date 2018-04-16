<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/3
 * Time: 10:24
 */

namespace app\Models\bus;
use Server\CoreBase\Model;

class User extends  Model
{
    protected $bus;
    protected $table = 'user';
    public function __construct()
    {
        parent::__construct();
        $this->bus = get_instance()->getAsynPool("bus");
        $this->redis = get_instance()->getAsynPool("redisPool");
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
        if ($this->bus != null) {
            $this->installMysqlPool($this->bus);
        }
    }


    public function getOneByPhone($phone) {
        $res = $this->bus->dbQueryBuilder->select("*")->where('phone',$phone)->from($this->table)->query();
        return $res->result_array();
    }

    public function records()
    {
        $sql = 'select sum(bet) as m , sum(profit)  as n from  '.$this->table.' where  create_time between  '.mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time())) .' and '.mktime(23,59,59,date('m',time()),date('d',time()),date('Y',time()));
        $bet_today = $this->test->dbQueryBuilder->query($sql);
        return $bet_today->getResult();
    }

    public function day()
    {
        $sql = "select ymd , DATE_FORMAT(ymd,'%W')  as  Week,sum(bet) as m ,sum(profit) as n from ssc  group by ymd ORDER BY create_time desc";
        $res = $this->test->dbQueryBuilder->query($sql);
        return $res->getResult();
    }

}

