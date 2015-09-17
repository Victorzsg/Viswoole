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
    $root = explode('\\', trim($class, '\\'));
    if (count($root) > 1) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        include_once __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
    }
}
