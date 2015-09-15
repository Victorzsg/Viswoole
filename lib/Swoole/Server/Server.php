<?php

namespace Swoole\Server;

class Server {

    const SERVER_TYPE_HTTP = "http";
    const SERVER_TYPE_TCP = "tcp";
    const SERVER_TYPE_UDP = "udp";

    private static $instance = null;
    private $config = array();
    private $type = self::SERVER_TYPE_TCP;

    private function __construct($type, $config) {
        !empty($type) && $this->type = $type;
        !empty($config) && $this->config = $config;
    }

    public static function getInstance($type, $config) {

        if (!($this->instance instanceof BaseServer)) {
            switch ($type) {
                case self::SERVER_TYPE_HTTP:
                    $this->instance = new HttpServer($config);
                    break;
                case self::SERVER_TYPE_TCP:
                    $this->instance = new TcpServer($config);
                    break;
                case self::SERVER_TYPE_UDP:
                    $this->instance = new UdpServer($config);
                    break;
            }
        }
        return $this->instance;
    }

}
