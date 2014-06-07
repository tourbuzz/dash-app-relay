<?php

require_once __DIR__ . '/vendor/autoload.php';

$loop = React\EventLoop\Factory::create();

$socket = new React\Socket\Server($loop);
$socket->on('connection', function ($conn) {
    $conn->write("Hello there!\n");
    $conn->write("Welcome to this amazing server!\n");
    $conn->write("Send over any string in format: keys=php&query=array and I'll open it in Dash\n");

    $conn->on('data', function ($data) use ($conn) {
        $docRequest = array();
        parse_str($data, $docRequest);

        $conn->write("Searching {$docRequest['keys']} for {$docRequest['query']}\n");
        $dashUrl = escapeshellarg("dash-plugin://{$data}");
        `open dash-plugin://{$dashUrl}`;

        $conn->close();
    });
});
$socket->listen(1337);

print "Starting Dash documentation lookup server..." . PHP_EOL;
$loop->run();

