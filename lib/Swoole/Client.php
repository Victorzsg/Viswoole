<?php

namespace Swoole;

class Client {

    /**
     * @var swoole_client
     */
    protected $client;
    public $errMsg;

    const EOF = "\r\n";

    function __construct($ip = '127.0.0.1', $port = 9510, $timeout = 2.0) {
        $client = new swoole_client(SWOOLE_SOCK_TCP);
        $client->set(array('open_eof_check' => true, 'package_eof' => EOF));
        if (!$client->connect($ip, $port, $timeout)) {
            throw new Exception("cannot connect to server [$ip:$port].");
        }
        $this->client = $client;
    }

    function push($data) {
        if ($this->client->send("PUSH " . $data . EOF)) {
            $result = $this->client->recv();
            if ($result === false) {
                return false;
            }
            if (substr($result, 0, 2) == 'OK') {
                return true;
            } else {
                $this->errMsg = substr($result, 4);
                return false;
            }
        } else {
            return false;
        }
    }

    function pop() {
        if ($this->client->send("POP " . EOF)) {
            $result = $this->client->recv();
            if ($result === false) {
                return false;
            }
            if (substr($result, 0, 2) == 'OK') {
                return substr($result, 3, strlen($result) - 3 - strlen(EOF));
            } else {
                $this->errMsg = substr($result, 4);
                return false;
            }
        } else {
            return false;
        }
    }

}
