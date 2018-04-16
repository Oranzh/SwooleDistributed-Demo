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

    public function insert($data)
    {
        $res = $this->bus->dbQueryBuilder->insert($this->table)->set($data)->query();
        return $res->insert_id();
    }

    public function passwd($passwd)
    {
        return substr(md5($passwd),10,16);
    }

    public function validatePasswd($passwd,$md5_passwd)
    {
        if ($this->passwd($passwd) != $md5_passwd) return false;
        return true;
    }
}

