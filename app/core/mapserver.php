<?php

require '../app/vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Http\HttpServerInterface;
use Ratchet\WebSocket\WsServer;

class MapServer implements MessageComponentInterface, HttpServerInterface {
    protected $server;

    public function __construct(WsServer $server) {
        $this->server = $server;
    }

    public function onOpen(ConnectionInterface $conn) {
        // New connection established
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Handle incoming message (e.g., cell selection)
        // Broadcast update to all connected clients

        //need a getClients() function
        foreach ($this->server->getClients() as $client) {
            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // Connection closed
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        // Error occurred
    }
}

$server = new HttpServer(new MapServer(new WsServer($this->server)));
//will need to check why HttpServer->listen() isn't working
$server->listen(9000, 'localhost');