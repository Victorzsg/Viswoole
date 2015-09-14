<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Viswoole_Worker
 *
 * @author Vic
 */

namespace Viswoole;

class Viswoole_Worker {

    /**
     * log manage
     */
    private $logger;

    /**
     * Instantiate a new worker, given a list of queues that it should be working
     * on. The list of queues should be supplied in the priority that they should
     * be checked for jobs (first come, first served)
     *
     * Passing a single '*' allows the worker to work on all queues in alphabetical
     * order. You can easily add new queues dynamically and have them worked on using
     * this method.
     *
     * @param string|array $queues String with a single queue name, array with multiple.
     */
    public function __construct() {
        $this->logger = new Viswoole_Log();
    }

    /**
     * get the status of the server worker
     */
    public function getStat() {
        
    }

}
