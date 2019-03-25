<?php 
/**
 * 错误的udp，尚未完成
 * @var swoole_server
 */
$serv = new swoole_server("192.168.19.129", 9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);
$serv -> set ([
	// worker 进程数量 cpu 1-4
	'worker_num' => 4,
	'max_request' => 10000,
]);
/**
 * 
 */
$serv -> on('pack', function($serv,$data,$addr){
	$fd = unpack('L', pack('N', ip2long($addr['address'])))[1];
	$reactor_id = ($addr['server_socket'] << 16) + $addr['port'];
	echo "client {$reactor_id} sent: {$data}.\n";
	var_dump($addr);
	// $serv -> send($addr,"Server:{$reactor_id} - {$fd} says:".$data."\n");
	// $serv -> send($fd,"you says:".$data."\n");
});

$serv -> on('receive', function($serv,$fd,$reactor_id,$data){
	echo "receive:{$reactor_id} - {$fd} data:".$data."\n";

	$serv -> send($fd,"Server:{$reactor_id} - {$fd} says:".$data."\n");
});


$serv->start();

 ?>