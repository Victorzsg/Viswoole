<?php

namespace Database;

abstract class Base implements DataInterface {

    /**
     *
     * @var type 
     */
    protected $name = "";

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

    public function __construct() {
        ;
    }

}
