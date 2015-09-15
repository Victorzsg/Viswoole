<?php

namespace Swoole\Server;

abstract class BaseServer implements \Swoole\Interfaces\Protocol {

    /**
     * The SSDB server host
     * @var string
     */
    private $host = "localhost";

    /**
     * The SSDB server port
     * @var int 
     */
    private $port = 6501;

}
