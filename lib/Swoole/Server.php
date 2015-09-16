<?php

namespace Swoole;

use Swoole\Server\Serv;

class Server implements Interfaces\Driver {

    const EOF = "\r\n";

    protected $server;
    protected $server_conf;

    public function init() {
        $this->setServer();
        $this->setting();
        $this->on();
    }

    public function __construct() {
        $this->server_conf = require CONFPATH . 'server.php';
    }

    public function setServer() {
        $this->server = Serv::getInstance(SERVER_TYPE_TCP, $this->server_conf);
    }

    public function setting() {
        $swoole_setting = $this->server_conf["swoole_setting"];
        $swoole_setting['open_eof_check'] = true;
        $swoole_setting['open_eof_split'] = true;
        $swoole_setting['package_eof'] = self::EOF;
        $this->server->swoole_server->set($swoole_setting);
    }

    public function on() {
        $this->server->on('WorkerStart', [$this->server, 'onStart']);
        $this->server->on('WorkerStop', [$this->server, 'onStop']);
        //$this->server->swoole_server->on('receive', [$this->server, 'onReceive']);
        $this->server->on('connect', function ($serv, $fd) {
            echo "Client:Connect.\n";
        });
        $this->server->on('receive', function ($serv, $fd, $from_id, $data) {
            $serv->send($fd, 'Swoole: ' . $data);
            $serv->close($fd);
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

    /*
      function listen($host = '0.0.0.0', $port = 9510) {
      $swoole_setting = require dirname(__DIR__) . '/configs/swoole.php';
      $server = new swoole_server($host, $port, SWOOLE_BASE);
      $swoole_setting['open_eof_check'] = true;
      $swoole_setting['open_eof_split'] = true;
      $swoole_setting['package_eof'] = self::EOF;
      $server->set($swoole_setting);
      $server->on('WorkerStart', [$this, 'onStart']);
      $server->on('WorkerStop', [$this, 'onStop']);
      $server->on('receive', [$this, 'onReceive']);
      $this->server = $server;
      $this->server->start();
      } */

    function send($client_id, $data) {
        
    }

    function close($client_id) {
        
    }

}
