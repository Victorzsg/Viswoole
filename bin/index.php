<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


define("LIBPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define("CONFPATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR);

require LIBPATH . 'Viswoole.php';

function autoload($class) {
    $root = explode('\\', trim($class, '\\'));
    if (count($root) > 1) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        include_once LIBPATH . $class . '.php';
    }
}

spl_autoload_register('autoload');

$viswoole = new Viswoole();
$viswoole->createTcpServer();
$viswoole->run();

