<?php

/**
 * 常量配置文件
 */
//数据库类型
define("DATA_TYPE_SSDB", "ssdb");
define("DATA_TYPE_REDIS", "redis");

//服务类型
define("SERVER_TYPE_TCP", "tcp");
define("SERVER_TYPE_UDP", "udp");
define("SERVER_TYPE_HTTP", "http");

//数据库操作类型
define("HASH_TYPE_SET", "set");
define("HASH_TYPE_GET", "get");
define("LIST_TYPE_POP", "pop");
define("LIST_TYPE_PUSH", "push");

//基本常量配置
define("EOF", "\r\n");

//错误编码
define("NULL_QUEUE_DATA", 1000);

//服务队列名称
define("LIST_QUEUE", "list_queue");
define("LIST_TEMP_QUEUE", "list_temp_queue");
define("LIST_FINISH_QUEUE", "list_finish_queue");
define("HASH_FUNCTION_QUEUE", "hash_function_queue");
define("HASH_TEMP_QUEUE", "hash_temp_queue");
