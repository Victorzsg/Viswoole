<?php

/**
 * Viswoole服务进程
 * 继承自接口Driver
 * 
 * @package		Swoole/Server
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Swoole;

use Swoole\Server\Serv;

class Server implements Interfaces\Driver {

    /**
     * swoole服务实例
     * @var object eg. TcpServer HttpServer... 
     */
    protected $server;

    /**
     * swoole服务参数
     * @var array 
     */
    protected $server_conf;

    /**
     * 初始化Viswoole服务
     * 绑定swoole服务
     * 设置swoole服务参数
     * 绑定回调函数
     */
    public function init() {
        $this->setServer();
        $this->setting();
        $this->on();
    }

    /**
     * 构造函数
     * 读取swoole服务配置文件
     */
    public function __construct() {
        $this->server_conf = require CONFPATH . 'server.php';
    }

    /**
     * 实例化swoole并绑定
     */
    public function setServer() {
        $type = array_key_exists("type", $this->server_conf) ? $this->server_conf["type"] : SERVER_TYPE_TCP;
        $this->server = Serv::getInstance($type, $this->server_conf);
    }

    /**
     * 设置swoole服务参数
     */
    public function setting() {
        $swoole_setting = $this->server_conf["swoole_setting"];
        $swoole_setting['open_eof_check'] = true;
        $swoole_setting['open_eof_split'] = true;
        $swoole_setting['package_eof'] = EOF;
        $this->server->swoole_server->set($swoole_setting);
    }

    /**
     * 绑定相应回调函数
     */
    public function on() {
        $this->server->on('WorkerStart', [$this->server, 'onStart']);
        $this->server->on('WorkerStop', [$this->server, 'onStop']);
        $this->server->on('receive', [$this->server, 'onReceive']);
        $this->server->on('connect', function ($serv, $fd) {
            echo "Client:Connect.\n";
        });
        $this->server->on('close', function ($serv, $fd) {
            echo "Client: Close.\n";
        });

        /* // Set Event Server callback function
          $this->sw->on('Start', array($this, 'onMasterStart'));
          $this->sw->on('ManagerStart', array($this, 'onManagerStart'));
          $this->sw->on('WorkerStart', array($this, 'onWorkerStart'));
          $this->sw->on('Connect', array($this, 'onConnect'));
          $this->sw->on('Receive', array($this, 'onReceive'));
          $this->sw->on('Close', array($this, 'onClose'));
          $this->sw->on('WorkerStop', array($this, 'onWorkerStop'));
          $this->sw->on('timer',array($this, 'onTimer'));
          if ($this->enableHttp) {
          $this->sw->on('Request', array($this, 'onRequest'));
          }
          if (isset($this->setting['task_worker_num'])) {
          $this->sw->on('Task', array($this, 'onTask'));
          $this->sw->on('Finish', array($this, 'onFinish'));
          } */
    }

    /**
     * 运行swoole服务
     */
    public function run() {
        $this->server->swoole_server->start();
    }

    /* protected $root;
      protected $config;
      protected $head_index;
      protected $tail_index;
      protected $pop_count = 0;
      protected $push_count = 0;
     */

    /* function __construct() {
      $this->root = dirname(__DIR__);
      $this->config = require $this->root . '/configs/leveldb.php';
      if (!is_dir($this->root . '/data/')) {
      mkdir($this->root . '/data/');
      }
      } */

    /**
     * 发送数据
     * @param int $client_id
     * @param string $data
     */
    function send($client_id, $data) {
        
    }

    /**
     * 关闭服务
     * @param int $client_id
     */
    function close($client_id) {
        
    }

}
