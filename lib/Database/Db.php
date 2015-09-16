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
     * 实例构造函数
     * 
     */
    private function __construct() {
        
    }

    /**
     * 实例化
     * @param string $type
     * @param array $config
     * @return object eg. Ssdb Redis...
     */
    public static function getInstance($type, $config) {

        if (!(self::$instance instanceof BaseDb)) {
            $class = 'Database\\'.ucfirst($type);
            if (class_exists($type)) {
                self::$instance = new $class((array) $config);
            } else {
                self::$instance = null;
            }
        }
        return self::$instance;
    }

}
