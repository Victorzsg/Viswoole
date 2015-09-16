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
     */
    public function pop() {
        $this->db_client->lpop(self::LIST_QUEUE);
    }

    /**
     * 接口函数 入队
     * 接口类出队函数的具体实现
     * @param string $data 入队数据
     */
    public function push($data) {
        $this->db_client->lpush(self::LIST_QUEUE, $data);
    }

    /**
     * 接口函数 设置函数
     * @param string $data 函数数据
     */
    public function set($data) {
        $this->db_client->hset(self::HASH_QUEUE, $data, 1);
    }

    /**
     * 接口函数 获取函数
     * @param string $data 函数数据
     */
    public function get($data) {
        $this->db_client->hget(self::HASH_QUEUE, $data);
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
