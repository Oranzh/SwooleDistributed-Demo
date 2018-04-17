<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 22:54
 */
namespace app;

use Throwable;

class BlueFatalException extends BlueException
{
    public function __construct($message = "", $code = -1, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}