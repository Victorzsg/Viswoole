<?php

/**
 * Tcp服务操作基类 TcpServer
 * 继承自服务操作基类BaseServer
 * 
 * @package		Swoole/Server/TcpServer
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Swoole\Server;

class TcpServer extends BaseServer {

    /**
     * 构造函数
     * 实例化服务处理对象
     * @param array $config
     * @throws CException
     */
    public function __construct($config = array()) {
        parent::__construct();
        $this->setDb();
        array_key_exists("hostname", $config) && $this->host = $config["hostname"];
        array_key_exists("post", $config) && $this->port = $config["port"];
        $this->swoole_server = new \swoole_server($this->host, $this->port);
    }

    public function onShutdown($serv, $workerId) {
        
    }

    public function onConnect($server, $fd, $fromId) {
        echo "ffff\n";
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

        $json_data = json_decode($data, TRUE);
        empty($json_data) && $json_data = array();
        $op = array_key_exists("op", $json_data) ? strtolower($json_data["op"]) : "";
        $op_data = array_key_exists("data", $json_data) ? $json_data["data"] : "";

        switch ($op) {
            case HASH_TYPE_SET://设置函数调用
                $this->db->set($op_data);
                break;
            case HASH_TYPE_GET://获取函数
                $this->db->get($op_data);
                break;
            case LIST_TYPE_POP:
                $this->db->pop();
                break;
            case LIST_TYPE_PUSH:
                $this->db->push($op_data);
            default:
                break;
        }
        $serv->send($fd, 'Swoole: ' . $data);
        $serv->close($fd);
        /* $op = strtolower(strstr($data, ' ', true));
          //出队
          if ($op == 'pop') {
          if ($this->head_index >= $this->tail_index) {
          $serv->send($fd, 'ERR empty' . EOF);
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
          $serv->send($fd, 'OK ' . $result . EOF);
          } else {
          $serv->send($fd, 'ERR get() failed.' . EOF);
          }
          }
          //入队
          elseif ($op == 'push') {
          $result = $this->leveldb->set('data_' . $this->tail_index, substr($data, 5, strlen($data) - 5 - strlen(EOF)));
          if ($result) {
          $this->tail_index++;
          $this->push_count++;
          //if ($this->push_count % 1000)
          {
          $this->leveldb->set('_tail_index', $this->tail_index);
          }
          $serv->send($fd, 'OK ' . EOF);
          } else {
          $serv->send($fd, 'ERR write to leveldb failed.' . EOF);
          }
          } elseif ($op == 'stats') {
          $serv->send($fd, 'OK ' . var_export(['head_index' => $this->head_index,
          'tail_index' => $this->tail_index,
          'push_count' => $this->push_count,
          'pop_count' => $this->pop_count,
          ], true) . EOF);
          } else {
          $serv->send($fd, 'ERR unsupported command [' . $op . ']' . EOF);
          } */
    }

    public function onStop() {
        echo "stop\n";
        /*
          $this->leveldb->set('_head_index', $this->head_index);
          $this->leveldb->set('_tail_index', $this->tail_index); */
    }

    /**
     * 绑定swoole服务回调函数
     * @param string $name
     * @param string|array $param
     */
    public function on($name, $param) {
        $this->swoole_server->on($name, $param);
    }

}
