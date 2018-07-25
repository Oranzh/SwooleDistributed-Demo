<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/7/19
 * Time: 3:15
 */

namespace app\Models\commit\sd3;


use app\Exception\BlueWarningException;
use app\Models\dao\MysqlDao;


class Create extends MysqlDao
{


    public function perform()
    {
        $params = $this->context['commit'];
        $this->db->begin(function () use ($params)
        {
            return $this->db->insert($this->table)->set($params)->query()->affected_rows();
        },function (){
            throw new BlueWarningException('添加失败');
        });
    }

}