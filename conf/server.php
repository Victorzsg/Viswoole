<?php

return array(
    "hostname" => "localhost",
    "port" => 9501,
    "swoole_setting" => array(
        'worker_num' => 2, //工作进程数量
        'daemonize' => true, //是否作为守护进程
    ),
);

