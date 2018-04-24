<?php
namespace app\Tasks;

use Server\CoreBase\Task;
use Server\Start;

/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午1:06
 */
class AppTask extends Task
{
    public function testTask()
    {
		if(Start::isLeader()) {
			secho('appTask','ok');
			//return "test task\n";
		}
    }
    public function err() {
        return $res;
    }
}
