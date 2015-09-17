<?php

/**
 * Redis数据库操作基类 Redis
 * 继承自数据库基类BaseDb
 * 
 * @package		Database/Redis
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Database;

class Redis extends BaseDb {

    /**
     * 接口函数 出队
     * 接口类出队函数的具体实现
     * @param string $queue_name 队列名
     */
    public function pop($queue_name) {
        return $this->db_client->lpop($queue_name);
    }

    /**
     * 接口函数 入队
     * 接口类出队函数的具体实现
     * @param string $queue_name 队列名
     * @param string $data 入队数据
     */
    public function push($queue_name, $data) {
        return $this->db_client->lpush($queue_name, $data);
    }

    /**
     * 接口函数 hash数据设置
     * @param string $name 队列名
     * @param string $key 键值
     * @param string $value 数据
     */
    public function set($name, $key, $value) {
        return $this->db_client->hset($name, $key, $value);
    }

    /**
     * 接口函数 hash数据获取
     * @param string $name 队列名
     * @param string $key 键值
     */
    public function get($name, $key) {
        return $this->db_client->hget($name, $key);
    }

    /**
     * 构造函数
     * 实例化redis处理对象并连接redis服务器
     * @param array $config
     * @throws CException
     */
    public function __construct($config) {

        array_key_exists("hostname", $config) && $this->hostname = $config["hostname"];
        array_key_exists("port", $config) && $this->port = $config["port"];
        array_key_exists("password", $config) && $this->password = $config["password"];
        array_key_exists("prefix", $config) && $this->prefix = $config["prefix"];
        array_key_exists("database", $config) && $this->database = $config["database"];
        array_key_exists("timeout", $config) && $this->timeout = $config["timeout"];

        $this->db_client = new \Redis();
        $this->db_client->connect($this->hostname, $this->port, $this->timeout);
        if (isset($this->password)) {
            if ($this->db_client->auth($this->password) === false) {
                throw new CException('Redis authentication failed!');
            }
        }
        $this->db_client->setOption(\Redis::OPT_PREFIX, $this->prefix);
        $this->db_client->select($this->database);
    }

}
