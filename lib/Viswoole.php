<?php

use Swoole\Server;

class Viswoole {

    const VERSION = '1.0';

    /**
     * @var Viswoole_Ssdb Instance of Viswoole_Ssdb that talks to ssdb.
     */
    public static $db = null;
    private $server;

    public function __construct() {
        
    }

    /**
     * Return an instance of the Viswoole_Ssdb class instantiated for Viswoole.
     *
     * @return Viswoole_Ssdb Instance of Viswoole_Ssdb.
     */
    public static function db() {
        
    }

    public static function createTcpServer() {
        $this->server = new Server(Server\Server::SERVER_TYPE_TCP);
        $this->server->run();
    }

    public static function createHttpServer() {
        $this->server = new Server(Server\Server::SERVER_TYPE_HTTP);
        $this->server->run();
    }

}
