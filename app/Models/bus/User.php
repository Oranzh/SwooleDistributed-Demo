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

class User extends  Model
{
    protected $bus;
    protected $pub_key;
    protected $table = 'user';
    protected $redis_table = 'user';
    public function __construct()
    {
        parent::__construct();
        $this->bus = get_instance()->getAsynPool("bus");
    }

    public function initialization(&$context)
    {
        parent::initialization($context);
        if ($this->bus != null) {
            $this->installMysqlPool($this->bus);
        }
    }


    public function getOneByPhone($phone) {
        $res = $this->redis_pool->getCoroutine()->hGet($this->redis_table,$phone);
        if (empty($res)) {
            $res = $this->bus->dbQueryBuilder->select("*")->where('phone', $phone)->from($this->table)->query();
            $res = $res->result_array();
            if (empty($res)) return false;
            $res = $res[0];
            $this->redis_pool->getCoroutine()->hSet($this->redis_table, $phone, json_encode($res));
        } else {
            $res = json_decode($res,true);
        }
        return $res;
    }

    public function getOneById($id)
    {
        $res = $this->redis_pool->getCoroutine()->hGet($this->redis_table,$id);
        if (empty($res)) {
            $res = $this->bus->dbQueryBuilder->select("*")->where('id', $id)->from($this->table)->query();
            $res = $res->result_array();
            if (empty($res)) throw new BlueWarningException('用户信息无效');
            $res = $res[0];
            $this->redis_pool->getCoroutine()->hSet($this->redis_table, $id, json_encode($res));
        } else {
            $res = json_decode($res,true);
        }
        return $res;
    }

    public function insert($data)
    {
        $res = $this->bus->dbQueryBuilder->insert($this->table)->set($data)->query();
        return $res->insert_id();
    }

    public function update($data,$id)
    {
        $this->bus->dbQueryBuilder->begin(function () use($data,$id)
        {
            $res = $this->bus->dbQueryBuilder->update($this->table)
                ->set('avatar',$data['avatar'])
                ->set('nickname',$data['nickname'])
                ->where('id',$id)
                ->query();
            $rows = $res->affected_rows();
            if ($rows == 0) throw new BlueWarningException('更新失败');
            $user_info = $this->getOneById($id);
            $this->redis_pool->getCoroutine()->hDel($this->redis_table,$user_info['phone']);
            return $res->affected_rows();
        },function()
        {
            throw new BlueWarningException('更新失败');
        });

    }

    /**
     * @param $passwd 用户密码
     * @return bool|string
     */
    public function passwd($passwd)
    {
        return password_hash($passwd, PASSWORD_BCRYPT);
    }

    /**
     * @param $passwd 用户密码
     * @param $hash 数据库中存的hash
     * @return bool
     */
    public function validatePasswd($passwd,$hash)
    {
        if (password_verify($passwd,$hash)) return true;
        return false;
    }

    /**
     * @param $token
     * @return bool|array
     */
    public function getInfo($token)
    {
        if (empty($token['encrypted']) or empty($token['hash_key'])) return false;
        $token = decode_aes($token['encrypted'],$token['hash_key'],true);
        if (empty($token) or empty($token['time']))  return false;
        if (isset($token['expire'])) {
            if ($token['time'] + 86400 * $token['expire'] < time()) return false;
        } else {
            //默认15天
            if ($token['time'] + 86400 * 15 < time()) return false;
        }
        return $token;
    }

    public function login($phone,$passwd)
    {
        $user_info = $this->getOneByPhone($phone);
        if (!$this->validatePasswd($passwd,$user_info['passwd'])) throw new BlueWarningException('用户信息无效');
        $token = [
            'id' => $user_info['id'],
            'phone' => $user_info['phone'],
            'time' => time(),
            'expire' => 30
        ];
        $token = encode_aes($token,$this->pub_key,true);
        return [
            'id' => $user_info['id'],
            'phone' => $phone,
            'toekn' => $token,
        ];
    }
}

