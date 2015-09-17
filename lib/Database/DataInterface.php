<?php

/**
 * 数据库接口类 DataInterface
 * 
 * @package		Database/DataInterface
 * @author             Victor<victorzsg@gmail.com>
 */

namespace Database;

interface DataInterface {

    /**
     * 接口函数 出队
     * @param string $name 队列名
     */
    function pop($name);

    /**
     * 接口函数 入队
     * @param string $name 队列名
     * @param string $data 入队数据
     */
    function push($name, $data);

    /**
     * 接口函数 hash数据设置
     * @param string $name 队列名
     * @param string $key 键值
     * @param string $value 数据
     */
    function set($name, $key, $value);

    /**
     * 接口函数 hash数据获取
     * @param string $name 队列名
     * @param string $key 键值
     */
    function get($name, $key);
}
