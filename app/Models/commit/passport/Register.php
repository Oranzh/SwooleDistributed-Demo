<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/8/6
 * Time: 12:42
 */

namespace app\Models\commit\passport;

use app\Exception\BlueWarningException;
use app\Models\dao\Passport;

class Register extends Passport
{
    public function perform()
    {
        $params = $this->context['commit'];
        $params['create_time'] = $params['update_time'] = time();
        $passport = $this->getFromName($params['name']);
        if (!empty($passport)) throw new BlueWarningException('用户已经存在');
        $params['password'] = password_hash($params['password'],PASSWORD_BCRYPT);
        $this->db->begin(function () use ($params)
        {
            $rows = $this->db->insert($this->table)->set($params)->query()->affected_rows();
            if ($rows != 1) throw new BlueWarningException('添加失败');
        },function (){
            throw new BlueWarningException('添加失败');
        });
    }
}