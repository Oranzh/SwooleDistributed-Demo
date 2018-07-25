<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/7/19
 * Time: 17:36
 */

namespace app\Models\commit\sd3;


use app\Models\dao\MysqlDao;
use app\Exception\BlueWarningException;

class Update extends MysqlDao
{
    public function perform()
    {
        $params = $this->context['commit'];
        $this->db->begin(function () use ($params)
        {
            $id = $params['id'];
            unset($params['id']);
            $this->db->update($this->table)
                ->set('num','num+1',false)
                ->where('id',$id)
                ->query();
            $rows = $this->db->update($this->table)
                ->set($params)
                ->where('id',$id)
                ->query()
                ->affected_rows();
            //抛异常回滚
            if ($rows != 1) throw new BlueWarningException('更新失败');
        },function () {
            //接口返回数据，更新失败，且flag为1
            throw new BlueWarningException('更新失败');
        });
    }
}