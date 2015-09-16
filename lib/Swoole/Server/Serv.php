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
     * 服务对应参数数组
     * @var array
     */
    private $config = array();

    /**
     * 服务类型
     * @var string
     */
    private $type = SERVER_TYPE_TCP;

    /**
     * 实例构造函数
     * @param string $type
     * @param array $config
     */
    private function __construct($type, $config) {
        !empty($type) && $this->type = $type;
        !empty($config) && $this->config = $config;
    }

    /**
     * 实例化
     * @param string $type
     * @param array $config
     * @return object eg. TcpServer,HttpServer...
     */
    public static function getInstance($type, $config) {

        if (!(self::$instance instanceof BaseServer)) {
            switch ($type) {
                case SERVER_TYPE_HTTP:
                    self::$instance = new HttpServer($config);
                    break;
                case SERVER_TYPE_TCP:
                    self::$instance = new TcpServer($config);
                    break;
                case SERVER_TYPE_UDP:
                    self::$instance = new UdpServer($config);
                    break;
            }
        }
        return self::$instance;
    }

}
