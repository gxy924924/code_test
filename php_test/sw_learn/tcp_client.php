<?php 
//创建server 对象，监听ip和端口
$client = new swoole_client(SWOOLE_SOCK_TCP);

if(!$client->connect('192.168.19.129',9501)){
	echo "连接失败!";
	exit();
}

fwrite(STDOUT, "请输入消息：");
$msg = trim(fgets(STDIN));

$client ->send($msg);

$result = $client->recv();
echo $result;

 ?>