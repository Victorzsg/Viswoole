<?php

namespace Swoole\Interfaces;

interface Driver {

    function run();

    function send($client_id, $data);

    function close($client_id);

    function setServer();
    
    function setDb();
}
