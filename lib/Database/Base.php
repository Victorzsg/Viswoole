<?php

namespace Database;

abstract class Base implements DataInterface {

    /**
     *
     * @var type 
     */
    private $name = "";

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

    public function __construct() {
        ;
    }

}
