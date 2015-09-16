<?php

namespace Swoole\Server;

use Database\Db;

abstract class BaseServer implements \Swoole\Server\Protocol {

    /**
     * The SSDB server host
     * @var string
     */
    protected $host = "localhost";

    /**
     * The SSDB server port
     * @var int 
     */
    protected $port = 9501;
    public $swoole_server = null;
    protected $db = null;
    protected $db_conf = null;

    public function __construct() {
        $this->db_conf = require CONFPATH . 'db.php';
    }

    public function setDb() {
        $this->db = Db::getInstance(DATA_TYPE_REDIS, $this->db_conf);
    }

}
