<?php

/**
 * 服务实例单例模式 Serv
 * 
 * @package		Swoole/Server/Serv
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Swoole\Server;

class Serv {

    /**
     * 实例化的服务对象
     * @var object eg. TcpServer,HttpServer...
     */
    private static $instance = null;

    /**
     * 实例构造函数
     * @param string $type
     * @param array $config
     */
    private function __construct() {
        
    }

    /**
     * 实例化
     * @param string $type
     * @param array $config
     * @return object eg. TcpServer,HttpServer...
     */
    public static function getInstance($type, $config) {

        if (!(self::$instance instanceof BaseServer)) {
            $class = 'Swoole\\Server\\'.ucfirst($type) . 'Server';
            if (class_exists($class)) {
                self::$instance = new $class((array) $config);
            } else {
                self::$instance = null;
            }
        }
        return self::$instance;
    }

}
