<?php
require '../vendor/autoload.php';
require './mapserver.php';
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$mapServer = IoServer::factory(
    new HttpServer(
        new WsServer(
            new MapServer()
        )
    ),
    8080
);

$mapServer->run();
/*
cd app/core and 'php runserver.php'
*/