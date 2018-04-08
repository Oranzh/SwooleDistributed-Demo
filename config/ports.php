<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-14
 * Time: 下午1:58
 */

use Server\CoreBase\PortManager;

$config['ports'][] = [
    'socket_type' => PortManager::SOCK_TCP,
    'socket_name' => '0.0.0.0',
    'socket_port' => 9091,
    'pack_tool' => 'LenJsonPack',
    'route_tool' => 'NormalRoute',
    'middlewares' => ['MonitorMiddleware']
];

$config['ports'][] = [
    'socket_type' => PortManager::SOCK_HTTP,
    'socket_name' => '0.0.0.0',
    'socket_port' => 8081,
    'route_tool' => 'NormalRoute',
	//'socket_ssl' => true,
    'ssl_cert_file' => '/home/lee/sd/cert/214392470520546.crt',
    'ssl_key_file' => '/home/lee/sd/cert/214392470520546.key',
    'middlewares' => ['MonitorMiddleware', 'NormalHttpMiddleware'],
    'method_prefix' => 'http_'
];
$config['ports'][] = [
    'socket_type' => PortManager::SOCK_WS,
    'socket_name' => '0.0.0.0',
    'socket_port' => 8083,
	//'socket_ssl' => true,
    'ssl_cert_file' => '/home/lee/sd/cert/214392470520546.crt',
    'ssl_key_file' => '/home/lee/sd/cert/214392470520546.key',
    'route_tool' => 'N',
    'pack_tool' => 'N',
    'opcode' => PortManager::WEBSOCKET_OPCODE_TEXT,
    'middlewares' => ['MonitorMiddleware', 'NormalHttpMiddleware']
];

return $config;
