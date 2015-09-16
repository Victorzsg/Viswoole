<?php

namespace Database;

class Redis extends BaseDb {

    public function pop($data) {
        $this->db_client->lpop(self::LIST_QUEUE, $data);
    }

    public function push() {
        $this->db_client->lpush(self::LIST_QUEUE, $data);
    }

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
