<?php
//简单的swoole测试的例子
$server = new swoole_websocket_server("localhost",9200);

/**
 * 启动
 */
$server->on('open',function(swoole_websocket_server $server,$request){
    echo "server: handshake success with fd{$request->fd}\n";
});

/**
 * 收到信息
 */
$server->on('message',function(swoole_websocket_server $server,$frame){
    echo "receive from {$frame->fd}:{$frame->data}\n";
    echo "opcode:{$frame->opcode}\n";
    echo "fin: {$frame->finish}\n";
    $server->push($frame->fd,"this is a server index".$a);//服务端主动给客户端推送消息
});

/**
 * 关闭触发
 */
$server->on('close',function($ser,$fd){
    echo "client {$fd} closed\n";
});
 
$server->start();
 
	
?>
