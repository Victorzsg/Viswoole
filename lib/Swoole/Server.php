<?php

namespace Swoole;

class Server extends Network\Protocol\BaseServer implements Server\Driver {

    protected $root;
    protected $config;
    protected $server;
    protected $leveldb;
    protected $head_index;
    protected $tail_index;
    protected $pop_count = 0;
    protected $push_count = 0;

    const EOF = "\r\n";

    function __construct() {
        $this->root = dirname(__DIR__);
        $this->config = require $this->root . '/configs/leveldb.php';
        if (!is_dir($this->root . '/data/')) {
            mkdir($this->root . '/data/');
        }
    }

    function onStart(swoole_server $serv, $worker_id) {
        $this->leveldb = new LevelDB($this->root . '/data', $this->config['options'], $this->config['readoptions'], $this->config['writeoptions']);
        $this->head_index = (int) $this->leveldb->get('_head_index');
        $this->tail_index = (int) $this->leveldb->get('_tail_index');
    }

    function onReceive(swoole_server $serv, $fd, $reactor_id, $data) {
        $op = strtolower(strstr($data, ' ', true));
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
        }
    }

    function onStop() {
        $this->leveldb->set('_head_index', $this->head_index);
        $this->leveldb->set('_tail_index', $this->tail_index);
    }

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
    }

}
