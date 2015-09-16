<?php

/**
 * Viswoole服务进程接口类 Driver
 * 
 * @package		Swoole/Interfaces/Driver
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Swoole\Interfaces;

interface Driver {

    /**
     * 服务运行函数
     */
    function run();

    /**
     * 数据发送函数
     * @param int $client_id 
     * @param string $data 发送数据
     */
    function send($client_id, $data);

    /**
     * 服务关闭函数
     * @param int $client_id
     */
    function close($client_id);

    /**
     * 设置队列服务函数
     */
    function setServer();
}
