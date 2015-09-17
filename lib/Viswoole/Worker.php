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

    /**
     * @var array Array of all associated queues for this worker.
     */
    private $queues = array();

    /**
     * Instantiate a new worker, given a list of queues that it should be working
     * on. The list of queues should be supplied in the priority that they should
     * be checked for jobs (first come, first served)
     *
     * Passing a single '*' allows the worker to work on all queues in alphabetical
     * order. You can easily add new queues dynamically and have them worked on using
     * this method.
     *
     * @param string|array $queues String with a single queue name, array with multiple.
     */
    public function __construct() {
        //$this->logger = new Viswoole_Log();
        /*!is_array($param) && $param = array($param);
        $this->param = $param;*/
        $this->worker = new \swoole_client(SWOOLE_SOCK_TCP | SWOOLE_KEEP);
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
        $this->worker->connect($host, $port, 0.5, 1);
    }

    public function addFunction($function_name, $function) {
        $func = json_encode(array("op" => "set", "data" => array("funcname" => $function_name, "function" => $function)));
        $this->worker->send($func);
    }

    public function work() {
        $this->worker->connect($host, $port, 0.5, 1);
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
