<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/3
 * Time: 10:24
 */

namespace app\Models\bus;
use app\Exception\BlueWarningException;
use Server\CoreBase\Model;

class Post extends  Model
{
    protected $bus;
    protected $table = 'post';
    protected $redis_table = 'post';
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

    public function insert($data)
    {
        $res = $this->bus->dbQueryBuilder->insert($this->table)->set($data)->query();
        return $res->insert_id();
    }

    public function update($data,$id)
    {
        $res = $this->bus->dbQueryBuilder->update($this->table)
            ->set($data)
            ->where('id',$id)
            ->query();
        return $res->affected_rows();
    }

    /**
     * @param $id
     * @param $status
     */
    public function status($id,$status,$user_id)
    {
        $info = $this->get($id);
        if ($info['status'] >= $status or $user_id != $info['user_id']) throw new BlueWarningException('状态修改失败');
        $this->bus->dbQueryBuilder->update($this->table)
            ->set('status',$status)
            ->where('id',$id)
            ->query();
        $this->redis_pool->getCoroutine()->hDel($this->redis_table,$id);
    }

    public function get($id)
    {
        $res = $this->redis_pool->getCoroutine()->hGet($this->redis_table,$id);
        if (empty($res)) {
            $res = $this->bus->dbQueryBuilder->select("*")->where('id',$id)->from($this->table)->query();
            $res = $res->result_array();
            if (empty($res)) throw new BlueWarningException('信息无效');
            $res = $res[0];
            $this->redis_pool->getCoroutine()->hSet($this->redis_table,$id,json_encode($res));
            return $res;
        } else {
            return json_decode($res,true);
        }
    }
}

