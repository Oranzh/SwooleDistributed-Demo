<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:51
 */

namespace app\Controllers;

use app\Models\TestModel;
use Server\Asyn\Mysql\Miner;
use Server\Components\Consul\ConsulServices;
use Server\Components\Event\EventDispatcher;
use Server\CoreBase\Controller;
use Server\CoreBase\SelectCoroutine;
use Server\Memory\Cache;
use Server\Memory\Lock;
use Server\Tasks\TestTask;
use oranzh\Oranzh;
use Respect\Validation\Validator;
use Server\Components\CatCache\CatCacheRpcProxy;
use Server\Components\CatCache\TimerCallBack;

class Test extends Controller
{
    /**
     * @var TestTask
     */
    public $testTask;

    /**
     * @var TestModel
     */
    public $testModel;

    /**
     * @var SdTcpRpcPool
     */
    protected $sdrpc;
	protected $GetIPAddressHttpClient;
	protected $RPC;
	protected $lee;


	public function initialization($controller_name, $method_name)
    {   
        parent::initialization($controller_name, $method_name);
        $this->GetIPAddressHttpClient = get_instance()->getAsynPool('GetIPAddress');
        $this->RPC = get_instance()->getAsynPool('RPC');
        $this->sdrpc = get_instance()->getAsynPool('sdrpc');
        $this->lee = get_instance()->getAsynPool('lee');
    }
	
	/**
	 * http连接池
	 */

	public function http_test_ip() {
	    //print_r($this->GetIPAddressHttpClient);
		$ip = $this->http_input->server('remote_addr');
		//$ip = $this->http_input->get('ip');
		$response = yield $this->GetIPAddressHttpClient->httpClient
                ->setQuery(['format' => 'json', 'ip' => $ip])
                ->coroutineExecute('/iplookup/iplookup.php');
        $body = json_decode($response['body'], true);	
		$this->http_output->end($body,false);
	}

	/**
	 * 请求Task中不存在的方法不报错
	 */
    public function http_map_add()
    {
        $cache = Cache::getCache('SdTask');
        $cache->addMap('123');
        $this->http_output->end($cache->getAllMap());
    }

	public function http_task() {
		$sdTask = $this->loader->task('SdTask');
		$sdTask->dump();
		$res = yield $sdTask->coroutineSend();
		//$sdTask->startTask(null);
		$this->http_output->end($res);
	}


    public function http_ex()
    {
        $testModel = $this->loader->model('TestModel', $this);
        yield $testModel->test_exception();
    }

    public function http_mysql()
    {
        //$model = $this->loader->model(SdModel::class);
		print_r(SdModel::class);
        //$result = yield $model->testMysql();
        //$this->http_output->end($result);
        $this->http_output->end(SdModel::class);
    }

    /**
     * tcp的测试
     */
    public function testTcp()
    {
        secho('testTcp','come here');
        return 'this is tcp client';
		echo 123;
        //var_dump($this->client_data);
        //$this->send($this->client_data);
    }

    public function add()
    {
        $max = $this->client_data->max;
        if (empty($max)) {
            $max = 100;
        }
        $sum = 0;
        for ($i = 0; $i < $max; $i++) {
            $sum += $i;
        }
        $this->send($max);
    }

    public function http_testContext()
    {
        $this->getContext()['test'] = 1;
        $this->testModel = $this->loader->model('SdModel', $this);
        $result = $this->testModel->contextTest();
		//$this->http_output->end($result);
        $this->http_output->end($this->getContext());
    }

    /**
     * mysql 事务协程测试
     */
    public function http_mysql_begin_coroutine_test()
    {
        $id = yield $this->mysql_pool->coroutineBegin($this);
		var_dump($id);
        $update_result = yield $this->mysql_pool->dbQueryBuilder->update('user_info')->set('sex', '1')->where('uid', 10000)->coroutineSend($id)->dump();
        $result = yield $this->mysql_pool->dbQueryBuilder->select('*')->from('user_info')->where('uid', 10000)->coroutineSend($id)->dump();
		print_r($result);
        if ($result['result'] and $result['result'][0]['channel'] == 1000) {
            $this->http_output->end('commit');
            yield $this->mysql_pool->coroutineCommit($id);
        } else {
            $this->http_output->end('rollback');
            yield $this->mysql_pool->coroutineRollback($id);
        }
    }

    /**
     * 绑定uid
     */
    public function bind_uid()
    {
        $this->bindUid($this->client_data->data, true);
        $this->destroy();
    }

    /**
     * 效率测试
     * @throws \Server\CoreBase\SwooleException
     */
    public function efficiency_test()
    {
        $data = $this->client_data->data;
        $this->sendToUid(mt_rand(1, 100), $data);
    }

    /**
     * 效率测试
     * @throws \Server\CoreBase\SwooleException
     */
    public function efficiency_test2()
    {
        $data = $this->client_data->data;
        $this->send($data);
    }

    /**
     * mysql效率测试
     * @throws \Server\CoreBase\SwooleException
     */
    public function http_smysql()
    {
        $result = yield $this->mysql_pool->dbQueryBuilder->select('*')->from('account')->where('uid', 10004)->coroutineSend();
        $this->http_output->end($result, false);
    }

    public function http_amysql()
    {
        $result = get_instance()->getMysql()->select('*')->from('account')->where('uid', 10004)->pdoQuery();
        $this->http_output->end($result, false);
    }

    public function http_cmysql()
    {
        $this->mysql_pool->dbQueryBuilder->select('*')->from('account')->where('uid', 10004);
        $this->mysql_pool->query(function ($result) {
            $this->http_output->end($result, false);
        });

    }

    /**
     * 获取mysql语句
     */
    public function http_mysqlStatement()
    {
        $value = $this->mysql_pool->dbQueryBuilder->insertInto('account')->intoColumns(['uid', 'static'])->intoValues([[36, 0], [37, 0]])->getStatement(true);
        $this->http_output->end($value);
    }

    /**
     * http测试
     */
    public function http_test()
    {
        $max = $this->http_input->get('max');
        if (empty($max)) {
            $max = 100;
        }
        $sum = 0;
        for ($i = 0; $i < $max; $i++) {
            $sum += $i;
        }
        $this->http_output->end($sum);
    }

    public function http_redirect()
    {
        $this->redirectController('TestController', 'test');
    }

    /**
     * health
     */
    public function http_health()
    {
        $this->http_output->end('1');
    }

    /**
     * http redis 测试
     */
    public function http_redis()
    {
        $result = yield $this->redis_pool->getCoroutine()->get('testroute');
        $this->http_output->end($result, false);
    }

    /**
     * http redis 测试
     */
    public function http_redis2()
    {
        $this->redis_pool->getRedisPool()->get('testroute', function () {
            $this->http_output->end(1, false);
        });
    }

    /**
     * http redis 测试
     */
    public function http_setRedis()
    {
        $result = yield $this->redis_pool->getCoroutine()->set('testroute', 81586424);
        $this->http_output->end($result);
    }

    /**
     * http 同步redis 测试
     */
    public function http_aredis()
    {
        $value = get_instance()->getRedis()->get('testroute');
        $this->http_output->end($value, false);
    }

    /**
     * html测试
     */
    public function http_html_test()
    {
        $template = $this->loader->view('server::error_404');
        $this->http_output->end($template->render(['controller' => 'TestController\html_test', 'message' => '页面不存在！']));
    }

    /**
     * html测试
     */
    public function http_html_file_test()
    {
        $this->http_output->endFile(SERVER_DIR, 'Views/test.html');
    }

    /**
     * select方法测试
     * @return \Generator
     */
    public function http_test_select()
    {
        yield $this->redis_pool->getCoroutine()->set('test', 456);
        yield $this->redis_pool->getCoroutine()->set('test1', 4567);
        yield $this->redis_pool->getCoroutine()->set('test2', 45678);
        $c1 = $this->redis_pool->getCoroutine()->get('test');
        $c2 = $this->redis_pool->getCoroutine()->get('test1');
        $c3 = $this->redis_pool->getCoroutine()->get('test2');
        $result = yield SelectCoroutine::Select(function ($resul) {
            if ($resul < 4567) {
                return true;
            }
            return false;
        }, $c2, $c1,$c3);
        $this->http_output->end($result);
    }

    public function http_getAllTask()
    {
        $messages = get_instance()->getServerAllTaskMessage();
        $this->http_output->end(json_encode($messages));
    }

    /**
     * @return boolean
     */
    public function isIsDestroy()
    {
        return $this->is_destroy;
    }

    public function http_lock()
    {
        $lock = new Lock('test2');
        $result = yield $lock->coroutineLock();
        $this->http_output->end($result);
    }

    public function http_unlock()
    {
        $lock = new Lock('test1');
        $result = yield $lock->coroutineUnlock();
        $this->http_output->end($result);
    }

    public function http_destroylock()
    {
        $lock = new Lock('test1');
        $lock->destroy();
        $this->http_output->end(1);
    }

    public function http_testTask()
    {
        $testTask = $this->loader->task(TestTask::class, $this);
        $testTask->testMysql();
        $result = yield $testTask->coroutineSend();
        $this->http_output->end($result);
    }

    public function http_testConsul()
    {
        $rest = ConsulServices::getInstance()->getRESTService('MathService', $this->context);
        $rest->setQuery(['one' => 1, 'two' => 2]);
        $reuslt = yield $rest->add();
        $this->http_output->end($reuslt['body']);
    }

    public function http_testConsul2()
    {
        $rest = ConsulServices::getInstance()->getRPCService('MathService', $this->context);
        $reuslt = yield $rest->add(1, 2);
        $this->http_output->end($reuslt);
    }

    public function http_testConsul3()
    {
        $rest = ConsulServices::getInstance()->getRPCService('MathService', $this->context);
        $reuslt = yield $rest->call('add', [1, 2], true);
        $this->http_output->end($reuslt);
    }

    public function http_testRedisLua()
    {
        $value = yield $this->redis_pool->getCoroutine()->evalSha(getLuaSha1('sadd_from_count'), ['testlua', 100], 2);
        $this->http_output->end($value);
    }

    public function http_testTaskStop()
    {
        $task = $this->loader->task('TestTask', $this);
        $task->testStop();
        yield $task->coroutineSend();
    }

    public function http_echo()
    {
        $this->http_output->end(123, false);
    }

    /**
     * 事件处理
     */
    public function http_getEvent()
    {
        $data = yield EventDispatcher::getInstance()->addOnceCoroutine('unlock')->setTimeout(25000);
        //这里会等待事件到达，或者超时
        $this->http_output->end($data);
    }

    public function http_sendEvent()
    {
        EventDispatcher::getInstance()->dispatch('unlock', 'hello block');
        $this->http_output->end('ok');
    }

    public function http_testWhile()
    {
        $this->testModel = $this->loader->model('TestModel', $this);
        yield $this->testModel->testWhile();
        $this->http_output->end(1);
    }

    public function http_testMysqlRaw()
    {
        $selectMiner = $this->mysql_pool->dbQueryBuilder->select('*')->from('account');
        $selectMiner = $selectMiner->where('', '(status = 1 and dec in ("ss", "cc")) or name = "kk"', Miner::LOGICAL_RAW);
        $this->http_output->end($selectMiner->getStatement(false));
    }

    public function http_getAllUids()
    {
        $uids = yield get_instance()->coroutineGetAllUids();
        $this->http_output->end($uids);
    }

    public function http_getConfig()
    {
		$res = $this->config->get('mailer','没有啊');
		$this->log('hahahhaha');
		$this->http_output->setContentType('text/xml')->end($res,false);
    }

	public function http_sendEmail() {
		secho('sd','-----------monitor-----------');
		$emailTask = $this->loader->task('tools/SwiftMailerTask',$this);
		$emailTask->sendEmail();
		//异步任务
		//$emailTask->startTask();
		//$emailTask->startTaskWait();
		//协程
		$res = $emailTask->coroutineSend();
		$this->http_output->end($res);
	}

	//tcpclientPool如何使用
	public function http_rpc() {
		//$this->Rpc->send('hello','sub');
		$this->http_output->end($this->Rpc);
	}
	public function http_oranzh() {
		$oranzh = new Oranzh;
		$res = $oranzh->test();
		$this->http_output->end($res,false);
	}

	public function http_ps() {
		$res = '这卡的真';
		return 123;
		secho('SAMBA',$res);
        $this->http_output->end($res,false);
    }
    /**
     * 测试过了,正常使用,sdTcpRcp比tcpClient好用
     */

    public function http_tcp()
    {
        $this->sdrpc = get_instance()->getAsynPool('sdrpc');
        $data = $this->sdrpc->helpToBuildSDControllerQuest($this->context, 'MathService', 'add');
        $data['params'] = [1, 2];
        $result = yield $this->sdrpc->coroutineSend($data);
        $this->http_output->end($result);
    }
    /**
     * 测试TCP客户端
     * 不用send发送数据,用协程
     */
    public function http_tcp2()
    {
        $this->rpc = get_instance()->getAsynPool('RPC');
        $data = [
            'path' => '/Test/add3',
            'controller_name' => 'Test',
            'method_name' => 'add3',
            'params' => [3,4,5],
        ];
        $callback = ['app\Controllers\Test','add3'];
		$res = $this->rpc->send($data,$callback);
		$this->http_output->end($res);
    }

    public function add2() {
        secho('add2',$this->client_data);
        $emailTask = $this->loader->task('tools/SwiftMailerTask',$this);
        $emailTask->sendEmail();
        //异步任务
        //$emailTask->startTask();
        //$emailTask->startTaskWait();
        //协程
        $res = yield $emailTask->coroutineSend();
        $this->send($res);
    }

    /**
     * Tcp客户端协程发送数据
     */
    public function http_tcp3()
    {
        $this->sdrpc = get_instance()->getAsynPool('RPC');
        $data = [
            'path' => '/Test/add3',
            'controller_name' => 'Test',
            'method_name' => 'add3',
            'params' => [7,2,5],
        ];
        $res = yield $this->sdrpc->coroutineSend($data);
        $this->http_output->end($res);
    }

    public function add3($num1,$num2,$num3) {
        secho('add3','come here');
        $res = $num1 * $num2 * $num3;
        $this->send($res);
    }

    /**
     * 和SD服务器进行通讯
     * 测试成功
     */
    public function http_tcp4()
    {
        $this->lee = get_instance()->getAsynPool('lee');
        $data = $this->lee->helpToBuildSDControllerQuest($this->context, 'MathService', 'tt');
        $data['params'] = [1, 2];
        $result = yield $this->lee->coroutineSend($data);
        $this->http_output->end($result);
    }

    public function http_ssl() {
		$num = $this->http_input->get('num');
		$res = Validator::intVal()->between(10, 20)->validate($num);
		if($res) {
			$this->http_output->end($num,false);
		} else {
			$this->http_output->end('----------------',false);
		}
    }

    public function http_bindip() {
        $server = getBindIp();
        $this->http_output->end($server,false);
    }

	public function http_validator() {
		var_dump(Validator::age(18)->validate('17 years ago')); // false
		var_dump(Validator::age(18)->validate('18 years ago')); // true
		var_dump(Validator::age(18)->validate('19 years ago')); // true
		var_dump(Validator::age(18)->validate('1970-01-01')); // true
		var_dump(Validator::age(18)->validate('today')); // false	
		$this->http_output->end('-------ok---------',false);
	}

    public function http_testSC1()
    {
        $result = yield CatCacheRpcProxy::getRpc()->offsetExists('test.a');
        secho('catcache',$result);
        var_export($result);
        $this->http_output->end($result, false);
    }

    public function http_testSC2()
    {
        unset(CatCacheRpcProxy::getRpc()['test.a']);
        $this->http_output->end(1, false);
    }


    public function http_testSC3()
    {
        CatCacheRpcProxy::getRpc()['test.a'] = ['a' => 'a', 'b' => [1, 2, 3,5]];
        $this->http_output->end(1, false);
    }

    public function http_testSC4()
    {
        $result = yield CatCacheRpcProxy::getRpc()['test.a.a'];
        $this->http_output->end($result, false);
    }

    public function http_testSC5()
    {
        $result = yield CatCacheRpcProxy::getRpc()->getAll();
        $this->http_output->end($result, false);
    }

    public function http_testTimerCallBack()
    {
        $token = yield TimerCallBack::addTimer(2, TestModel::class, 'testTimerCall', [123]);
        $this->http_output->end($token);
    }

    public function http_testActor()
    {
        Actor::create(TestActor::class, "actor");
        Actor::call("actor", "test");
        $this->http_output->end(123);
    }

    public function http_testActor2()
    {
        Actor::call("actor", "destroy");
        $this->http_output->end(123);
    }

	public function http_testRPC() {
		$rest = ConsulServices::getInstance()->getRPCService('MathService', $this->context);
		$reuslt = yield $rest->sd(3, 4);
		$this->http_output->end($reuslt);
	}


}
