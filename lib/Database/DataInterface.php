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
     */
    function pop();

    /**
     * 接口函数 入队
     * @param string $data 入队数据
     */
    function push($data);
}
