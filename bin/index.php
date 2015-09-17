<?php

define("LIBPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define("CONFPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR);

require LIBPATH . 'Viswoole.php';

$viswoole = new Viswoole();
$viswoole->createTcpServer();
$viswoole->run();

