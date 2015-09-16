<?php

/**
 * 服务操作基类 BaseServer
 * 继承自接口Protocol
 * 
 * @package		Swoole/Server/BaseServer
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Swoole\Server;

use Database\Db;

abstract class BaseServer implements Protocol {

    /**
     * 服务地址 eg. 127.0.0.1
     * @var string
     */
    protected $host = "localhost";

    /**
     * 服务端口号 eg. 9501
     * @var int 
     */
    protected $port = 9501;

    /**
     * swoole服务实例
     * @var object swoole_server 
     */
    public $swoole_server = null;

    /**
     * 数据库实例
     * @var object eg. Redis Ssdb... 
     */
    protected $db = null;

    /**
     * 数据库参数
     * @var array 
     */
    protected $db_conf = null;

    /**
     * 构造函数
     * 加载数据库参数
     */
    public function __construct() {
        $this->db_conf = require CONFPATH . 'db.php';
    }

    /**
     * 设置服务对应队列存放数据库并进行实例化数据库实例
     */
    public function setDb() {
        $type = array_key_exists("type", $this->db_conf) ? $this->db_conf["type"] : DATA_TYPE_REDIS;
        $this->db = Db::getInstance($type, $this->db_conf);
    }

}
