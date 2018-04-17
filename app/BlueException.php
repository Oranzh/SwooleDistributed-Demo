<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/16
 * Time: 21:54
 */

namespace app;

use Throwable;

class BlueException extends \Exception
{
    public function __construct($message = "", $code = -1, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}