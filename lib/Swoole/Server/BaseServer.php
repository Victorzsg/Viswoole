<?php

namespace Swoole\Server;

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

}
