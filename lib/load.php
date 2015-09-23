<?php

/**
 * Viswoole全局函数
 * 
 * @author             Victor<victorzsg@gmail.com>
 */

/**
 * 自动加载类文件
 */
function __autoload($class) {
    strstr($class, "Viswoole_") && $class = str_replace("Viswoole_", "", $class);

    $root = explode('\\', trim($class, '\\'));
    if (count($root) > 1) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        include_once LIBPATH . DIRECTORY_SEPARATOR . $class . '.php';
    }
}
