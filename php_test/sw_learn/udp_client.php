<?php 
/**
 * 错误的udp，尚未完成
 * @var swoole_server
 */
$client = new swoole_client(SWOOLE_SOCK_UDP);

if(!$client->connect('192.168.19.129',9502)){
	echo "连接失败!";
	exit();
}

fwrite(STDOUT, "请输入消息：");
$msg = trim(fgets(STDIN));

$client ->send($msg);

// $result = $client->recv();
// echo $result;

 ?>