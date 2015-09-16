<?php

namespace Database;

class Db {

    private static $instance = null;
    private $config = array();
    private $type = DATA_TYPE_SSDB;

    private function __construct($type, $config) {
        !empty($type) && $this->type = $type;
        !empty($config) && $this->config = $config;
    }

    public static function getInstance($type, $config) {

        if (!(self::$instance instanceof Base)) {
            switch ($type) {
                case DATA_TYPE_SSDB:
                    self::$instance = new Ssdb($type, $config);
                    break;
                case DATA_TYPE_REDIS:
                    self::$instance = new Redis($type, $config);
                    break;
            }
        }
        return self::$instance;
    }

}
