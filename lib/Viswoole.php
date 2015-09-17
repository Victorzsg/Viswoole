<?php

/**
 * Viswoole服务操作
 * 
 * @package		Viswoole
 * @author             Victor<victorzsg@gmail.com>
 */
use Swoole\Server;

class Viswoole {

    /**
     * Viswoole版本号
     */
    const VERSION = '1.0';

    /**
     * Viswoole服务进程
     * @var object Server 
     */
    private $server;

    /**
     * 构造函数
     * 读取配置并设置相应常量
     */
    public function __construct() {
        require_once LIBPATH . 'Swoole' . DIRECTORY_SEPARATOR . 'Constant.php';
    }

    /**
     * 创建TcpServer服务
     * 并进行初始化
     */
    public function createTcpServer() {
        $this->server = new Server(SERVER_TYPE_TCP);
        $this->server->init();
    }

    /**
     * 创建HttpServer服务
     * 并进行初始化
     */
    public function createHttpServer() {
        $this->server = new Server(SERVER_TYPE_HTTP);
        $this->server->init();
    }

    /**
     * 运行Viswoole服务
     */
    public function run() {
        if (!($this->server instanceof Swoole\Server)) {
            var_dump("instance server error");
            exit();
        }
        $this->server->run();
    }

}
