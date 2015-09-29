<?php

define("LIBPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define("CONFPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR);

require_once LIBPATH . 'load.php';
//require_once LIBPATH . DIRECTORY_SEPARATOR . 'Viswoole' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'Worker.php';

$job = new \Viswoole\Viswoole_Job();
$job->addServer("127.0.0.1", 9501);
$function = "Swoole::authload";
$param = array("op" => "test", "data" => "data");
$job->toDo($function, $param);

