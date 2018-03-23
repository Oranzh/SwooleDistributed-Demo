<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/3/21
 * Time: 9:06
 */

namespace app\Models;

use Server\CoreBase\Model;
class AppModel extends  Model
{
    protected $table = 'users';
    protected $mysql = '';
    protected $sd = '';
    public function __construct()
    {
        parent::__construct();
        //$this->mysql = get_instance()->getAsynPool("mysqlPool");
        $this->sd = get_instance()->getAsynPool("test");
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
        if ($this->sd != null) {
            $this->installMysqlPool($this->sd);
        }
    }

    public function mysql() {
        var_dump($this->sd);
        $data = [
            'user_name' => 'lee123',
            'emails' => 'oranzh.cc@gmail.com',
        ];
        $res = $this->mysql_pool->dbQueryBuilder->insert($this->table)->set($data)->query();
        return $res->getResult();
    }

    public function getAll() {
        $res = $this->mysql_pool->dbQueryBuilder->select("*")->from($this->table)->query()->dump();
        return $res->getResult();
    }
}