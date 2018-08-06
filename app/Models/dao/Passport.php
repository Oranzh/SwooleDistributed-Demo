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
use app\Exception\BlueWarningException;

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
        //$this->db = $this->loader->mysql('wss',$this);
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

}