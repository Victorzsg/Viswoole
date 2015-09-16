<?php

/**
 * Http服务操作基类 HttpServer
 * 继承自服务操作基类BaseServer
 * 
 * @package		Swoole/Server/HttpServer
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Swoole\Server;

class HttpServer extends BaseServer {

    public function onReceive($server, $clientId, $fromId, $data) {
        
    }

    public function onStart($serv, $workerId) {
        
    }

    public function onShutdown($serv, $workerId) {
        
    }

    public function onConnect($server, $fd, $fromId) {
        
    }

    public function onClose($server, $fd, $fromId) {
        
    }

    public function onTask($serv, $taskId, $fromId, $data) {
        
    }

    public function onFinish($serv, $taskId, $data) {
        
    }

    public function onTimer($serv, $interval) {
        
    }

    public function onRequest($request, $response) {
        
    }

}
