<?php 
//创建server 对象，监听ip和端口
$server = new swoole_websocket_server("0.0.0.0", 9999);

// $server ->set([
// 	// 开启配置
// 	'enable_static_handler' => true,
// 	// 当此文件下有对应的文件，则直接读取对应目录下的文件（不安全）
// 	'document_root' => "/mnt/hgfs/centos_share/web",
// ]);

// 另一种回调函数调用方法
$server->on('open','onOpen');
function onOpen($server,$request){
	print_r($request->fd);
}

$server->on('message',function(swoole_websocket_server $server,$frame){
	echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
	$server->push($frame->fd, "this is server");
});

$server->on('close',function($ser,$fd){
	echo "client {$fd} close\n"
});

$server->start();




 ?>


