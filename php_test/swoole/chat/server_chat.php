<?php
/**
 * 简单聊天室`
 * 
 */
class Server { 
	private $serv; 
	private $client_fds;
	public function __construct() { 
		$this->serv = new swoole_server("0.0.0.0", 9501); 
		$this->serv->set(array( 
			'worker_num' => 1, 
		)); 
		$this->serv->on('Start', array($this, 'onStart')); 
		$this->serv->on('Connect', array($this, 'onConnect')); 
		$this->serv->on('Receive', array($this, 'onReceive')); 
		$this->serv->on('Close', array($this, 'onClose')); 
		$this->serv->start(); 
	} 

	public function onStart($serv) { 
		echo "Start\n"; 
	} 

	public function onConnect($serv, $fd, $from_id) { 
		echo "client {$fd} connect";
		$this->client_fds[$fd]=$fd;
		// $serv->send($fd, "client {$fd} connect"); 
	}
	
	// task使用
	public function onReceive(swoole_server $serv, $fd, $from_id, $data) {
		echo "Get Message From Client {$fd}:{$data}\n"; 
		// var_dump($serv);
		if($data=='fds'){
			$info=implode(',', $this->client_fds);
			$serv->send($fd,$info);
		}else{
			foreach ($this->client_fds as $client=>$val) {
				if($fd != $client){
					$serv->send($client,$data);
				}
			}
		}
		
			
	} 

	public function onClose($serv, $fd, $from_id) { 
		echo "Client {$fd} close connection\n"; 
		unset($this->client_fds[$fd]);
	} 
} 

// 启动服务器 
$server = new Server(); 


?>