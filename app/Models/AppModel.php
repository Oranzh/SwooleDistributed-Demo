<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/3/21
 * Time: 9:06
 */

namespace app\Models;

use Server\Components\CatCache\TimerCallBack;
use Server\CoreBase\Model;
class AppModel extends  Model
{
    protected $table = 'users';
    protected $mysql = '';
    protected $sd = '';
    public function __construct()
    {
        parent::__construct();
        $this->mysql = get_instance()->getAsynPool("mysqlPool");
        $this->test = get_instance()->getAsynPool("test");
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
        if ($this->test != null) {
            $this->installMysqlPool($this->test);
        }
        if ($this->mysql != null) {
            $this->installMysqlPool($this->mysql);
        }
    }

    public function mysql() {
        $data = [
            'user_name' => 'lee123'.rand(1000,9999),
            'emails' => 'oranzh.cc@gmail.com',
        ];
        $res = $this->mysql->dbQueryBuilder->insert($this->table)->set($data)->query();
        return $res->getResult();
    }

    public function getAll() {
        $res = $this->test->dbQueryBuilder->select("*")->from($this->table)->query();
        return $res->getResult();
    }

    public function timerCallBack($id,$var,$token)
    {
        var_dump(123123123);
        var_dump($var);
        $res = $this->test->dbQueryBuilder->update('users')
            ->set('user_name','callback')
            ->where('id',$id)
            ->query();
        TimerCallBack::ack($token);
        return $res->getResult();
    }
}