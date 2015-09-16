<?php

namespace Swoole\Server;

class TcpServer extends BaseServer {

    public function __construct($config = array()) {
        in_array("hostname", $config) && $this->host = $config["hostname"];
        in_array("post", $config) && $this->port = $config["port"];
        $this->swoole_server = new \swoole_server($this->host, $this->port, SWOOLE_BASE);
    }

    public function onShutdown($serv, $workerId) {
        
    }

    public function onConnect($server, $fd, $fromId) {
        
    }

    public function onClose($server, $fd, $fromId) {
        
    }

    public function onTask($serv, $taskId, $fromId, $data) {
        
    }

    public function onFinish($serv, $taskId, $data) {
        
    }

    public function onTimer($serv, $interval) {
        
    }

    public function onRequest($request, $response) {
        
    }

    public function onStart($serv, $worker_id) {
        echo "start\n";
        /* $this->leveldb = new LevelDB($this->root . '/data', $this->config['options'], $this->config['readoptions'], $this->config['writeoptions']);
          $this->head_index = (int) $this->leveldb->get('_head_index');
          $this->tail_index = (int) $this->leveldb->get('_tail_index'); */
    }

    public function onReceive($serv, $fd, $reactor_id, $data) {
        /* $op = strtolower(strstr($data, ' ', true));
          //出队
          if ($op == 'pop') {
          if ($this->head_index >= $this->tail_index) {
          $serv->send($fd, 'ERR empty' . self::EOF);
          return;
          }
          $result = $this->leveldb->get('data_' . $this->head_index);
          if ($result) {
          $this->leveldb->delete('data_' . $this->head_index);
          $this->head_index ++;
          $this->pop_count ++;
          //if ($this->pop_count % 1000)
          {
          $this->leveldb->set('_head_index', $this->head_index);
          }
          $serv->send($fd, 'OK ' . $result . self::EOF);
          } else {
          $serv->send($fd, 'ERR get() failed.' . self::EOF);
          }
          }
          //入队
          elseif ($op == 'push') {
          $result = $this->leveldb->set('data_' . $this->tail_index, substr($data, 5, strlen($data) - 5 - strlen(self::EOF)));
          if ($result) {
          $this->tail_index++;
          $this->push_count++;
          //if ($this->push_count % 1000)
          {
          $this->leveldb->set('_tail_index', $this->tail_index);
          }
          $serv->send($fd, 'OK ' . self::EOF);
          } else {
          $serv->send($fd, 'ERR write to leveldb failed.' . self::EOF);
          }
          } elseif ($op == 'stats') {
          $serv->send($fd, 'OK ' . var_export(['head_index' => $this->head_index,
          'tail_index' => $this->tail_index,
          'push_count' => $this->push_count,
          'pop_count' => $this->pop_count,
          ], true) . self::EOF);
          } else {
          $serv->send($fd, 'ERR unsupported command [' . $op . ']' . self::EOF);
          } */
        echo "resta\n";
    }

    public function onStop() {
        echo "stop\n";
        /*
          $this->leveldb->set('_head_index', $this->head_index);
          $this->leveldb->set('_tail_index', $this->tail_index); */
    }

}
