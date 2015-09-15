<?php

namespace Database;

class Db {

    const DATA_TYPE_SSDB = "ssdb";
    const DATA_TYPE_REDIS = "redis";

    private static $instance = null;
    private $config = array();
    private $type = self::DATA_TYPE_SSDB;

    private function __construct($type, $config) {
        !empty($type) && $this->type = $type;
        !empty($config) && $this->config = $config;
    }

    public static function getInstance($type, $config) {

        if (!($this->instance instanceof Base)) {
            switch ($type) {
                case self::DATA_TYPE_SSDB:
                    $this->instance = new Ssdb($type, $config);
                    break;
                case self::DATA_TYPE_REDIS:
                    $this->instance = new Redis($type, $config);
                    break;
            }
        }
        return $this->instance;
    }

}
