<?php

namespace Viswoole\Controller;

/**
 * TcpServer请求处理类
 */
class TcpController {

    /**
     * 请求数据入队
     * @param type $db
     * @param type $data
     * @return type
     */
    public static function InsQueueData($db, $data) {
        $output = $db->push(LIST_QUEUE, $data);
        return $output;
    }

    /**
     * 请求数据出队
     * @param type $db
     * @return type
     */
    public static function GetQueueData($db) {
        $queue_data = $db->pop(LIST_QUEUE);
        $queue_data && $db->push(LIST_TEMP_QUEUE, $queue_data);
        return $queue_data ? $queue_data : NULL_QUEUE_DATA;
    }

    public static function SetFunctionName($db, $function_name) {
        $back = $db->set(HASH_FUNCTION_QUEUE, $function_name, 1);
        return $back;
    }

    public static function GetFunctionName($db, $function_name) {
        $value = $db->get(HASH_FUNCTION_QUEUE, $function_name);
        return $value;
    }

}
