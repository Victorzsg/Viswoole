<?php

namespace Swoole;

/**
 * 观察者模式
 */
class Observer {

    /**
     * 唤醒worker
     * @param object swoole_server $server
     */
    public function wakenWorker($server) {
        $value = TcpController::GetFunctionName($this->db, $op_data);
        $flag = (empty($value)) ? FALSE : TRUE;
    }

}
