<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/6
 * Time: 12:37
 */

namespace app\Models\dao;

use Server\CoreBase\Model;
use Server\Asyn\Mysql\Miner;

class Passport extends Model
{
    protected $table = 'passport';

    public function __construct()
    {
        parent::__construct();
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
    }

    public function getFromName($name)
    {
        $res = $this->db->select('*')
            ->from($this->table)
            ->where('name',$name)
            ->query()
            ->row();
        return $res;
    }

    public function get($id)
    {
        $res = $this->db->select('*')
            ->from($this->table)
            ->where('id',$id)
            ->query()
            ->row();
        return $res;
    }

    public function getList($pn,$rn)
    {
        $res = $this->db->select('*')
            ->from($this->table)
            ->where('status',0)
            ->limit($rn,($pn-1)*$rn)
            ->query()
            ->result_array();
        return $res;
    }

	public function insert10()
	{
		for($i = 50000; $i <= 100000; $i++) {
			$params = [
				'id' => $i,
				'user_name' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,10),
				'emails' => 'a@b.com',
				'num' => mt_rand(1,100),
				];
			$this->db->insert($this->table)->set($params)->query();
		}
	}

}
