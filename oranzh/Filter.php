<?php
/**
 * Created by PhpStorm.
 * User: leexiaohui(oranzh.cc@gmail.com)
 * Date: 2018/4/24
 * Time: 15:17
 */

namespace oranzh;

use Respect\Validation\Validator as v;
use app\Exception\BlueWarningException;

class Filter
{
    /**
     * @param $var
     * @param int $min_age
     * @param int $max_age
     * @return mixed
     */
    public function age($var,int $min_age = null,int $max_age = null)
    {
        $res = false;
        if ($max_age == null) {
            $res = v::age($min_age)->validate($var);
        } elseif ($min_age == null) {
            $res = v::age(null,$max_age)->validate($var);
        } else {
            $res = v::age($min_age,$max_age)->validate($var);
        }
        if ($res) return $var;
        return null;
    }
}