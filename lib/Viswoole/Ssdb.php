<?php

/**
 * The methods about ssdb
 *
 * @package		Viswoole/Ssdb
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Viswoole;

class Viswoole_Ssdb {

    /**
     *
     * @var type 
     */
    private $name = "";

    /**
     *
     * @var type 
     */
    private $host = "localhost";

    /**
     *
     * @var type 
     */
    private $port = 6501;

    /**
     * @var array List of all commands in Redis that supply a key as their
     * 	first argument. Used to prefix keys with the Viswoole namespace.
     */
    private $keyCommands = array(
        'exists',
        'del',
        'type',
        'keys',
        'expire',
        'ttl',
        'move',
        'set',
        'setex',
        'get',
        'getset',
        'setnx',
        'incr',
        'incrby',
        'decr',
        'decrby',
        'rpush',
        'lpush',
        'llen',
        'lrange',
        'ltrim',
        'lindex',
        'lset',
        'lrem',
        'lpop',
        'blpop',
        'rpop',
        'sadd',
        'srem',
        'spop',
        'scard',
        'sismember',
        'smembers',
        'srandmember',
        'zadd',
        'zrem',
        'zrange',
        'zrevrange',
        'zrangebyscore',
        'zcard',
        'zscore',
        'zremrangebyscore',
        'sort',
        'rename',
        'rpoplpush'
    );

    /**
     * 
     */
    public function __construct() {
        ;
    }

    /**
     * 
     */
    public function getCount() {
        
    }

}
