<?php

use Swoole\Server;

class Viswoole {

    const VERSION = '1.0';

    private $server;

    public function __construct() {
        require_once LIBPATH . 'Swoole' . DIRECTORY_SEPARATOR . 'Constant.php';
    }

    public function createTcpServer() {
        $this->server = new Server(SERVER_TYPE_TCP);
        $this->server->init();
    }

    public function createHttpServer() {
        $this->server = new Server(SERVER_TYPE_HTTP);
        $this->server->init();
    }

    public function run() {
        if (!($this->server instanceof Swoole\Server)) {
            var_dump("instance server error");
            exit();
        }
        $this->server->run();
    }

}
