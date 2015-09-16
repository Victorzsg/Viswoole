<?php

namespace Database;

abstract class BaseDb implements DataInterface {
    
    const LIST_QUEUE = "list_queue";

    /**
     *
     * @var type 
     */
    public $db_client = null;

    /**
     * The SSDB server host
     * @var string
     */
    protected $hostname = "localhost";

    /**
     * The SSDB server port
     * @var int 
     */
    protected $port = 6501;
    protected $passwork = null;
    protected $prefix = "";
    protected $database = null;
    protected $timeout = 2000;

}
