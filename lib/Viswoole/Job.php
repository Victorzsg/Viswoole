<?php

/**
 * Viswoole任务操作
 * 
 * @package		Viswoole_Job
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Viswoole;

class Viswoole_Job {

    /**
     * @var LoggerInterface Logging object that impliments the PSR-3 LoggerInterface
     */
    private $logger;
    private $param = array();
    private $worker = null;
    private $callback = null;
    private $host;
    private $port;
    private $timeout = 0.5;
    private $socket = array();

    public function __construct() {

        include_once LIBPATH . DIRECTORY_SEPARATOR . 'Swoole' . DIRECTORY_SEPARATOR . 'Constant.php';
        $this->worker = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
        //$this->worker->set(array('open_eof_check' => true, 'package_eof' => EOF));
        $this->on();
    }

    protected function on() {
        $this->worker->on("connect", function($cli) {
            $arr = json_encode(array("op" => "push", "data" => "Swoole::autoload"));
            $cli->send($arr . EOF);
        });
        $this->worker->on("receive", function($cli, $data) {
            echo "Received: " . $data . "\n";
            $cli->close();
        });
        $this->worker->on("error", function($cli) {
            echo "Connect failed!\n";
        });
        $this->worker->on("close", function($cli) {
            echo "Connection close!\n";
            exit;
        });
    }

    public function addServer($host, $port) {
        $arr = array("host" => $host, "port" => $port);
        $this->socket[] = $arr;
    }

    public function toDo() {
        foreach ($this->socket as $key => $value) {
            if (!$this->worker->connect($this->socket[$key]["host"], $this->socket[$key]["port"], $this->timeout)) {
                throw new Exception("cannot connect to server [$this->host: $this->port].");
            }
        }
    }

    public function whileDo() {
        
    }

    /**
     * $client= new GearmanClient();

      # Add default server (localhost).
      $client->addServer();

      echo "Sending job\n";

      # Send reverse job
      $result = $client->do("server1", "netstat -nat | grep 80");
      if ($result)
      echo "Success: $result\n";
     */
    public static function callstatic() {
        
    }

}
