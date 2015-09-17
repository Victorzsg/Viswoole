<?php

/**
 * 数据库操作基类 BaseDb
 * 继承自接口DataInterface
 * 
 * @package		Database/BaseDb
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Database;

abstract class BaseDb implements DataInterface {

    /**
     * 由数据库类型决定 数据库对象
     * @var object(Redis Ssdb...)
     */
    public $db_client = null;

    /**
     * 数据库地址 eg. 127.0.0.1
     * @var string
     */
    protected $hostname = "localhost";

    /**
     * 数据库端口号 eg. 6379
     * @var int 
     */
    protected $port = 6379;

    /**
     * 数据库密码
     * @var string 
     */
    protected $password = null;

    /**
     * 数据库队列前缀
     * @var string
     */
    protected $prefix = "";

    /**
     * 数据库编号
     * @var int
     */
    protected $database = 0;

    /**
     * 数据库超时时间
     * @var int
     */
    protected $timeout = 2000;

}
