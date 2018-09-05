<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/8
 * Time: 14:02
 */

namespace app\Models\dao;


use Server\CoreBase\Model;

class Group extends Model
{
    protected $table = 'groups';

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

    public function getAll()
    {
        $res = $this->db->select('*')
            ->from($this->table)
            ->query()
            ->result_array();
        return $res;
    }
}