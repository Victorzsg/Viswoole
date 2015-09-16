<?php

namespace Swoole;

use Database\Db;
use Swoole\Server\Serv;

class Server implements Interfaces\Driver {

    const EOF = "\r\n";

    protected $server;
    protected $db;
    protected $server_conf;
    protected $db_conf;

    public function init() {
        $this->setDb();
        $this->setServer();
        $this->setting();
        $this->on();
    }

    public function __construct() {
        $this->db_conf = require CONFPATH . 'db.php';
        $this->server_conf = require CONFPATH . 'server.php';
    }

    public function setDb() {
        $this->db = Db::getInstance(DATA_TYPE_SSDB, $this->db_conf);
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
        $this->server->swoole_server->on('WorkerStart', [$this->server, 'onStart']);
        $this->server->swoole_server->on('WorkerStop', [$this->server, 'onStop']);
        //$this->server->swoole_server->on('receive', [$this->server, 'onReceive']);
        $this->server->swoole_server->on('connect', function ($serv, $fd) {
            echo "Client:Connect.\n";
        });
        $this->server->swoole_server->on('receive', function ($serv, $fd, $from_id, $data) {
            $serv->send($fd, 'Swoole: ' . $data);
            $serv->close($fd);
        });
        $this->server->swoole_server->on('close', function ($serv, $fd) {
            echo "Client: Close.\n";
        });
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
