<?php
	$port = 9501;
	// $serv = new swoole_server("127.0.0.1", $port, SWOOLE_BASE, SWOOLE_SOCK_TCP);
	$serv = new swoole_server("127.0.0.1", $port);
	$serv ->on('Connect', function($server){
		echo 'link start '.$server->host.':'.$server->port.PHP_EOL;
		// var_dump($server);
	});
	$serv->on('Receive', function($serv, $fd, $from_id, $data){
		echo 'receive....from:'.$from_id.' '.PHP_EOL;
		$serv->send($fd, 'Swoole: '.$data);
		echo 'send:'.$data;
	});
	$serv->on('Close', function($serv, $fd, $from_id){
		echo 'link stop from:'.$from_id.PHP_EOL;
		// $serv->stop();
	});

	$serv->start();
	


?>