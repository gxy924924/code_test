<?php
/**
 * worker->task
 * worker进程发送信号到task进程
 * 
 */
class Server { 
	private $serv; 
	public function __construct() { 
		$this->serv = new swoole_server("0.0.0.0", 9501); 
		$this->serv->set(array( 
			'worker_num' => 8, 
			'daemonize' => false, 
			'max_request' => 10000, 
			'dispatch_mode' => 2, 
			'debug_mode' => 1 ,
			'task_worker_num' => 4 ,
		)); 
		$this->serv->on('Start', array($this, 'onStart')); 
		$this->serv->on('Connect', array($this, 'onConnect')); 
		$this->serv->on('Receive', array($this, 'onReceive')); 
		$this->serv->on('Close', array($this, 'onClose')); 
		$this->serv->on('Task', array($this, 'onTask')); 
		$this->serv->on('Finish', array($this, 'onFinish')); 
		$this->serv->start(); 
	} 

	public function onStart($serv) { 
		echo "Start\n"; 
	} 

	public function onConnect($serv, $fd, $from_id) { 
		$serv->send($fd, "Hello {$fd}!"); 
	} 

	// public function onReceive(swoole_server $serv, $fd, $from_id, $data) { 
	// 	echo "Get Message From Client {$fd}:{$data}\n"; 
	// 	// $serv->send($fd, "server get info {$data}!"); 
	// } 
	
	// task使用
	public function onReceive(swoole_server $serv, $fd, $from_id, $data) { 
		echo "Get Message From Client {$fd}:{$data}\n"; 

		$data_send = array(
			'task' => 'task_1',
			'params' => $data,
			'fd' => $fd,
		);
		$serv->task(json_encode($data_send));
	} 

	public function onClose($serv, $fd, $from_id) { 
		echo "Client {$fd} close connection\n"; 
	} 

	public function onTask($serv, $task_id, $fd, $data) { 
		// sleep(8);
		echo "this task {$task_id} from {$fd}\n";
		echo "Data: {$data}\n";
		$data=json_decode($data,1);
		echo "Receive Task: {$data['task']}\n";
		var_dump($data['params']);

		$serv->send($data['fd'],"Hello task");
		return "task finish\n";
	}

	public function onFinish($serv, $task_id, $data){
		echo "finish get from {$task_id} data {$data}\n";
	}

} 

// 启动服务器 
$server = new Server(); 


?>