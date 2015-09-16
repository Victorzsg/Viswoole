<?php

/**
 * 数据库实例单例模式 Db
 * 
 * @package		Database/Db
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Database;

class Db {

    /**
     * 实例化的数据库对象
     * @var object eg. Ssdb,Redis...
     */
    private static $instance = null;

    /**
     * 数据库对应参数数组
     * @var array
     */
    private $config = array();

    /**
     * 数据库类型
     * @var string
     */
    private $type = DATA_TYPE_SSDB;

    /**
     * 实例构造函数
     * @param string $type
     * @param array $config
     */
    private function __construct($type, $config) {
        !empty($type) && $this->type = $type;
        !empty($config) && $this->config = $config;
    }

    /**
     * 实例化
     * @param string $type
     * @param array $config
     * @return object eg. Ssdb Redis...
     */
    public static function getInstance($type, $config) {

        if (!(self::$instance instanceof BaseDb)) {
            switch ($type) {
                case DATA_TYPE_SSDB:
                    self::$instance = new Ssdb((array) $config);
                    break;
                case DATA_TYPE_REDIS:
                    self::$instance = new Redis((array) $config);
                    break;
            }
        }
        return self::$instance;
    }

}
