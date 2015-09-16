<?php

/**
 * swoole服务进程回调函数接口类 Protocol
 * 
 * @package		Swoole/Server/Protocol
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Swoole\Server;

interface Protocol {

    function onStart($server, $workerId);

    function onConnect($server, $client_id, $from_id);

    function onReceive($server, $client_id, $from_id, $data);

    function onClose($server, $client_id, $from_id);

    function onShutdown($server, $worker_id);

    function onTask($serv, $task_id, $from_id, $data);

    function onFinish($serv, $task_id, $data);

    function onTimer($serv, $interval);

    /**
     * 设置服务对应队列存放数据库并进行实例化数据库实例
     */
    function setDb();
}
