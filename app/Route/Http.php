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

class Http implements IRoute
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
		secho('handleDate','123');
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
        secho('path_info',$request->server['path_info']);
        $this->client_data->path = $request->server['path_info'].'/hello';
        $route = explode('/', $request->server['path_info']);
		secho('route',$route);
        $count = count($route);
        if ($count == 2) {
            $this->client_data->controller_name = $route[$count - 1] ?? null;
            $this->client_data->method_name = 'hello';
            return;
        }
        $this->client_data->method_name = 'hello';
        $this->client_data->controller_name = implode("\\", $route);
		secho('method_name',$this->client_data->method_name);	
		secho('controller_name',$this->client_data->controller_name);	
    }

    /**
     * 获取控制器名称
     * @return string
     */
    public function getControllerName()
    {
		secho('getcontroller_name',$this->client_data->controller_name);	
        return $this->client_data->controller_name;
    }

    /**
     * 获取方法名称
     * @return string
     */
    public function getMethodName()
    {
		secho('getmethod_name',$this->client_data->method_name);	
        return $this->client_data->method_name;
    }

    public function getPath()
    {
		secho('getpath',$this->client_data->path);
        return $this->client_data->path ?? "";
    }

    public function getParams()
    {
		secho('paramn',$this->client_data->params);
        return $this->client_data->params??null;
    }

    public function errorHandle(\Throwable $e, $fd)
    {
        get_instance()->send($fd, "Error:" . $e->getMessage(), true);
        get_instance()->close($fd);
    }

    public function errorHttpHandle(\Throwable $e, $request, $response)
    {
        //重定向到404
        $response->status(302);
        $location = 'http://' . $request->header['host'] . "/" . '404';
        $response->header('Location', $location);
        $response->end('');
    }
}
