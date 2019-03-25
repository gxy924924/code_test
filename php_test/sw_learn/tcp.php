<?php 
//创建server 对象，监听ip和端口
$serv = new swoole_server("192.168.19.129", 9501);
$serv -> set ([
	// worker 进程数量 cpu 1-4
	'worker_num' => 4,
	'max_request' => 10000,
]);
/**
 * $fd 客户端连接的唯一标示
 * $reactor_id 线程id
 */
$serv -> on('connect', function($serv,$fd,$reactor_id){
	echo "client:{$reactor_id} - {$fd} - connect.\n";
});

$serv -> on('receive', function($serv,$fd,$reactor_id,$data){
	echo "receive:{$reactor_id} - {$fd} data:".$data."\n";
	$serv -> send($fd,"Server:{$reactor_id} - {$fd} says:".$data."\n");
});

$serv -> on('close',function($serv,$fd,$reactor_id){
	echo "client:{$reactor_id}-close\n";
});

$serv->start();

 ?>