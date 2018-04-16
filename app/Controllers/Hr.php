<?php

namespace app\Controllers;

use app\Models\wiki\Ssc;
use Server\CoreBase\Controller;
use Server\CoreBase\ChildProxy;



/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:51
 */
class Hr extends Controller
{
    /**
     * @var AppModel
     */

    protected $hr;
    protected $ssc;
    public function __construct($proxy = ChildProxy::class)
    {
        parent::__construct($proxy);
        $this->hr = get_instance()->getAsynPool("hr");

    }

    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->ssc = $this->loader->model(Ssc::class,$this);
    }


    public function http_hr()
    {
        //$codes,$money,$qishu,$times
        $codes = [123,234,567,456,589];
        $money = 0.5;
        $qishu = '20180416-059';
        $times = 5;
        $res = $this->ssc->hr($codes,$money,$qishu,$times);
        $this->http_output->end($res);
    }
}
