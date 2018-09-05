<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:11
 */

namespace app\Route;


use Server\Route\IRoute;
use Server\CoreBase\SwooleException;

class N implements IRoute
{
    private $client_data;

    public function __construct()
    {
        $this->client_data = new \stdClass();
    }

    /**
     * 设置反序列化后的数据 Object
     * @param $data
     * @return \stdClass
     * @throws SwooleException
     */
    public function handleClientData($data)
    {
        //这块接收到的是对象，而不是数组，自己组装数据格式
        $this->client_data = $data;
        if (isset($this->client_data->controller_name) && isset($this->client_data->method_name)) {
            return $this->client_data;
        } else {
            throw new SwooleException('route 数据缺少必要字段');
        }

    }

    /**
     * 处理http request
     * @param $request
     */
    public function handleClientRequest($request)
    {
        $this->client_data->path = $request->server['path_info'];
        $route = explode('/', $request->server['path_info']);
        //secho('path_info',$request->server['path_info']);
        ///wiki/Http/hello
        secho('route',$route);
        /**
        [
            0 => '',
            1 => 'wiki',
            2 => 'Http',
            3 => 'hello'
        ]
        **/
        $count = count($route);
        if ($count == 2) {
            $this->client_data->controller_name = ucfirst($route[$count - 1]) ?? null;
            $this->client_data->method_name = 'perform';
            return;
        }
//        $this->client_data->method_name = $route[$count - 1] ?? null;
        $this->client_data->method_name = 'perform';
        //unset($route[$count - 1]);
        $route[$count-1] = ucfirst($route[$count-1]);
        unset($route[0]);
        $this->client_data->controller_name = implode("\\", $route);
    }

    /**
     * 获取控制器名称
     * @return string
     */
    public function getControllerName()
    {
        //secho('getCname',$this->client_data->controller_name);
        return $this->client_data->controller_name;
    }

    /**
     * 获取方法名称
     * @return string
     */
    public function getMethodName()
    {
        //secho('getMethod',$this->client_data->method_name);
        return $this->client_data->method_name;
    }

    public function getPath()
    {
        //secho('getpath',$this->client_data->path);
        return $this->client_data->path ?? "";
    }

    public function getParams()
    {
        return $this->client_data->params??null;
    }

    public function errorHandle(\Throwable  $e, $fd)
    {
        get_instance()->send($fd, "Error:" . $e->getMessage(), true);
        get_instance()->close($fd);
    }

    public function errorHttpHandle(\Throwable $e, $request, $response)
    {
        //重定向到404
        $response->status(302);
        $location = 'https://' . $request->header['host'] . "/" . '404';
        $response->header('Location', $location);
        $response->end('');
    }
}
