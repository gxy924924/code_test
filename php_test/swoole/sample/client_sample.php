<?php
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function($cli) {
    $cli->send("hello world\n");
});
$client->on("receive", function($cli, $data){
    echo "received: {$data}\n";
});
$client->on("error", function($cli){
    echo "connect failed\n";
});
$client->on("close", function($cli){
    echo "connection close\n";
});
$client->on("bufferEmpty", function(swoole_client $cli){
    $cli->close();
});
if (!$client->connect('127.0.0.1', 9501,  0.5))
{
    exit("connect failed. Error: {$client->errCode}\n");
}
// $client->close();


?>