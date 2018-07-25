<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/7/3
 * Time: 11:10
 */

namespace app\Models\dao;

use app\Exception\BlueWarningException;
use Server\Components\CatCache\TimerCallBack;
use Server\CoreBase\Model;
use Server\Asyn\Mysql\Miner;
//Miner文档地址 https://github.com/jstayton/Miner

class MysqlDao extends  Model
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->loader->mysql('mysqlPool',$this);
        $this->redis = $this->loader->redis('redisPool');
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
    }

    public function createTable()
    {
        $sql = sprintf("
            CREATE TABLE `users` (
              `id` int(6) NOT NULL AUTO_INCREMENT,
              `user_name` varchar(20) NOT NULL,
              `emails` varchar(50) NOT NULL,
              `num` int NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8mb4;
        ");
        $res = $this->db->query($sql);
        return $res->dump();
    }

    public function insert($data)
    {
        try {
            $res = $this->db->insert($this->table)->set($data)->query();
        } catch (BlueWarningException $blueWarningException) {
            secho('sql','写入失败');
        }
        return $res->affected_rows();
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);
        $res = $this->db->update($this->table)->set($data)->where('id',$id)->query();
        $res = $res->affected_rows();
        return $res;
    }

    public function update2()
    {
        $res = $this->db->update($this->table)
            ->set('emails','lee@xiaohui.li')
            ->where('id',216)
            ->openWhere(Miner::LOGICAL_OR)
            ->where('user_name','leexiaohui')
            ->andWhere('num',7,Miner::NOT_EQUALS)
            ->closeWhere()
            ->query();
        return $res->affected_rows();
    }

    public function incr($id)
    {
        $res = $this->db->update($this->table)->set('num','num+1',false)->where('id',$id)->query();
        return $res->affected_rows();
    }

    public function in(array $id)
    {
        $res = $this->db->select('*')->from($this->table)->whereIn('id',$id)->andWhere('num',7)->query();
        return $res->getResult();
    }

    public function between()
    {
        $res = $this->db->select('*')
            ->from($this->table)
            ->whereBetween('num',2,7)
            ->query()->getResult();
        return $res;
    }

    public function select()
    {
        $res = $this->db->select('*')->from($this->table)->orderBy('num',Miner::ORDER_BY_DESC)->query();
        return $res->getResult();
    }

    public function count()
    {
        $res = $this->db->select('count(*) as n')->from($this->table)->query();
        return $res->getResult();
    }

    public function delete()
    {
        $res = $this->db->delete()
            ->from($this->table)
            ->where('id',218)
            ->andWhere('num',9)
            ->query();
        return $res->affected_rows();
    }

    public function selectOne($id)
    {
        $res = $this->db->select('*')
            ->from($this->table)
            ->where('id',$id)
            ->query()
            ->row();
        return $res;
    }

}