<?php

/**
 * Queue worker that handles checking queues for jobs, fetching them
 * off the queues, running them and handling the result.
 *
 * @package		Viswoole/Worker
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Viswoole;

class Viswoole_Worker {

    /**
     * @var LoggerInterface Logging object that impliments the PSR-3 LoggerInterface
     */
    private $logger;

    /**
     * @var array Array of all associated queues for this worker.
     */
    private $queues = array();

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
    public function __construct($queues) {
        $this->logger = new Viswoole_Log();

        !is_array($queues) && $queues = array($queues);

        $this->queues = $queues;
    }

    /**
     * get the status of the server worker
     */
    public function getStat() {
        
    }

}
