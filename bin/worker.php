<?php

define("LIBPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define("CONFPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR);

require_once LIBPATH . 'load.php';
//require_once LIBPATH . DIRECTORY_SEPARATOR . 'Viswoole' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'Worker.php';

$worker = new \Viswoole\Viswoole_Worker();
$worker->addServer("127.0.0.1", 9501);
$worker->addFunction("title", "title_function");
$worker->work();

