<?php

//https://www.youtube.com/watch?v=75CCxIBs4Ak&ab_channel=AlmaMaeBernales


//need to cd /d in cmd to core directory and run php -f websocket.php
//uncomment ;extension=sockets in php.ini

$host = "127.0.0.1";
$port = 8090;
set_time_limit(0);

$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket.\n");
$result = socket_bind($sock, $host, $port) or die("Could not bind to socket.\n");

$result = socket_listen($sock, 3) or die("Could not set up socket listener.\n");
echo "Listening for connections";

class Chat
{
    function readline() {
        return rtrim(fgets(STDIN));
    }
}

do {
    $accept = socket_accept($sock) or die("Could not accept incoming connection.");
    $input = socket_read($accept, 1024) or die("Could not read input.\n");

    $input = trim($input);
    echo "Client says:\t".$input,"\n\n";

    $line = new Chat();
    echo "Enter Reply:\t";

    $reply = $line->readline();

    socket_write($accept, $reply, strlen($reply)) or die("Could not write output.\n");
} while (true);

socket_close($accept, $sock);

?>