<?php
    $entryData = array(
        'category' => 'Programming'
      , 'title'    => "This is PHP."
    );

    // This is our new stuff
    $context = new ZMQContext();
    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
    $socket->connect("tcp://localhost:5555");

    $socket->send(json_encode($entryData));
