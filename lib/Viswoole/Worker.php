<?php

/**
 * Viswoole工作者操作
 * 
 * @package		Viswoole/Viswoole_Worker
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Viswoole;

class Viswoole_Worker {

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

    /**
     * @var array Array of all associated queues for this worker.
     */
    private $queues = array();

    public function __construct() {
        //$this->logger = new Viswoole_Log();
        /* !is_array($param) && $param = array($param);
          $this->param = $param; */
        $this->worker = new \swoole_client(SWOOLE_SOCK_TCP);
        $this->worker->set(array('open_eof_check' => true, 'package_eof' => EOF));
    }

    protected function on() {
        $this->worker->on("connect", function($cli) {
            $arr = json_encode(array("op" => "push", "data" => "Swoole::autoload"));
            $cli->send($arr . "\r\n");
        });
        $this->worker->on("receive", function($cli, $data) {
            echo "Received: " . $data . "\n";
        });
        $this->worker->on("error", function($cli) {
            echo "Connect failed\n";
        });
        $this->worker->on("close", function($cli) {
            echo "Connection close\n";
            exit;
        });
    }

    public function addServer($host, $port) {
        $this->host = $host;
        $this->port = $port;
        //$this->worker->connect($host, $port, 0.5, 1);
    }

    public function addFunction($function_name, $callback) {
        $func = json_encode(array("op" => "set", "data" => array("funcname" => $function_name, "function" => $callback)));
        $this->callback[$function_name] = $callback;
        /*$this->worker->send($func);
        if ($this->worker->send($func . EOF)) {
            $result = $this->worker->recv();
            if ($result === false) {
                return false;
            }
            if (substr($result, 0, 2) == 'OK') {
                return true;
            } else {
                $this->errMsg = substr($result, 4);
                return false;
            }
        } else {
            return false;
        }*/
    }

    public function work() {
        if (!$this->worker->connect($this->host, $this->port, $this->timeout)) {
            throw new Exception("cannot connect to server [$this->host: $this->port].");
        }
    }

    /**
     * $worker= new GearmanWorker();    
      $worker->addServer("127.0.0.1", 4730);
      $worker->addFunction("title", "title_function");
      while ($worker->work());

      function title_function($job)
      {
      $str = $job->workload();
      return strlen($str);
      }
     */
}
