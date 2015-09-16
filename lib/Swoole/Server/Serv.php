<?php

namespace Swoole\Server;

class Serv {

    private static $instance = null;
    private $config = array();
    private $type = SERVER_TYPE_TCP;

    private function __construct($type, $config) {
        !empty($type) && $this->type = $type;
        !empty($config) && $this->config = $config;
    }

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
