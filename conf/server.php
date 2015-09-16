<?php

/**
 * swoole服务配置文件
 * hostname swoole服务器 eg. 127.0.0.1
 * port swoole服务器端口号 eg. 9501
 * swoole_setting swoole相关参数设置 详见swoole官网说明
 * 
 * @package		
 * @author             Victor<victorzsg@gmail.com>
 */
return array(
    "hostname" => "localhost",
    "port" => 9501,
    "swoole_setting" => array(
        'worker_num' => 2, //工作进程数量
        'daemonize' => true, //是否作为守护进程
    ),
);

