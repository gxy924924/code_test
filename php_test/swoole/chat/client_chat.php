<?php

/**
 * 创建子进程，并通过管道进行通信
 * 管道中默认传递消息大小是受到限制的（65535）
 * 同步io/异步io 
 * io多路复用
 * epoll本质是阻塞io，它的优点能同时处理大量socket连接
 *
 * event loop :reactor 线程，其中运行了一个epoll实例
 * 可通过接口添加socket描述符到epoll监听中，并指定事件响应的回调函数
 * event loop不可再fpm下使用（因为它需要持续运行，fpm会在使用完后停掉）
 */

$socket = stream_socket_client("tcp://127.0.0.1:9501",$errno,$errstr,30);

function onRead(){
	global $socket;
	$buffer = stream_socket_recvfrom($socket, 1024);
	if(!$buffer){
		echo "server closed\n";
		swoole_event_del($socket);
	}
	echo "\nRECV:{$buffer}\n";
	fwrite(STDOUT, "Enter Msg:");
}

// ？？
function onWrite(){
	global $socket;
	echo "on Write\n";
}

function onInput(){
	global $socket;
	$msg = trim (fgets(STDIN));
	if( $msg == 'exit' ){
		swoole_event_exit();
		exit();
	}
	// swoole异步写入
	swoole_event_write($socket,$msg);
	fwrite(STDOUT,"Enter Msg:");
}

swoole_event_add($socket,'onRead','onWrite');
// 当监测到用户输入时调用对应函数
swoole_event_add(STDIN,'onInput');

fwrite(STDOUT, "Enter Msg:");

?>