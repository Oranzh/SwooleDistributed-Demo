<?php
namespace app\Tasks\tools;

use Server\CoreBase\Task;
use Server\Start;

/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午1:06
 */
class SwiftMailerTask extends Task
{
	protected $emailConfig;

	public function __construct() {

		parent::__construct();
	}

	public function sendEmail() {
        if (Start::isLeader()) {
            //echo "----task{$this->task_id}---start--\n\n";
            $this->emailConfig = $this->config->get('mailer');
            $transport = (new \Swift_SmtpTransport($this->emailConfig['transport'], $this->emailConfig['port']))
                ->setUsername($this->emailConfig['username'])
                ->setPassword($this->emailConfig['pwd']);
            $mailer = new \Swift_Mailer($transport);
            // Create a message
            $redBall = range(1, 33);
            shuffle($redBall);
            $red = array_rand($redBall, 6);
            $red = array($redBall[$red[0]], $redBall[$red[1]], $redBall[$red[2]], $redBall[$red[3]], $redBall[$red[4]], $redBall[$red[5]]);
            $red = implode(',', $red);
            $blueBall = range(1, 16);
            shuffle($blueBall);
            $blue = $blueBall[0];
            $body = sprintf('红球：%s ,蓝球 : %d', $red, $blue);
            $message = (new \Swift_Message('双色球' . date('Y-m-d').'---old---machine'))
                ->setFrom(array('admin@oranzh.cc' => '双色球'))
                ->setTo(array('81586424@qq.com'))
                ->setBody($body);
            $result = $mailer->send($message);
            secho('mailertask', 'over');
            //return $result;
        }
	}


	public function DrinkWater() {
	    if (Start::isLeader()) {
            $this->emailConfig = $this->config->get('mailer');
            $transport = ( new \Swift_SmtpTransport($this->emailConfig['transport'], $this->emailConfig['port']))
                ->setUsername($this->emailConfig['username'])
                ->setPassword($this->emailConfig['pwd'])
            ;
            $mailer = new \Swift_Mailer($transport);
            // Create a message
            $drink = [
                '猪,到点该喝水了!',
                '热水壶里的水烧好了,看一下,顺便喝点温白开!',
                '恒温壶水不多了,把剩下的一喝,再烧点倒恒温壶里!',
                '多喝水,不上火,嘿嘿!',
                '想要皮肤更好,还是得多喝水!',
                '喝水的时候,顺便记得给小橙子吃D3,^-^',
                '哈哈,I MISS　ＹＯＵ',
            ];
            $body = $drink[array_rand($drink)];
            $message =  (new \Swift_Message('DrinkWater,亲亲'))
                ->setFrom(array('admin@oranzh.cc' => '李二蛋'))
                ->setTo(array('841001007@qq.com'))
                ->setBody($body)
            ;
            // Send the message
            $result = $mailer->send($message);
        }

	}
}
