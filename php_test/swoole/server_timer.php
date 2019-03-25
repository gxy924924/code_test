<?php
/**
 * timer(timer_tick timer_after)
 * 服务计时器（定时器）(毫秒级)
 * 
 */
class test{
}
class Server { 
	private $serv; 
	private $pdo; 
	public function __construct() { 
		$this->serv = new swoole_server("0.0.0.0", 9501); 
		$this->serv->set(array( 
			'worker_num' => 4, 
			'daemonize' => false, 
			'max_request' => 10000, 
			'dispatch_mode' => 2, 
			'debug_mode' => 1 ,
			// 'task_worker_num' => 4 ,
		)); 
		$this->serv->on('Start', array($this, 'onStart')); 
		$this->serv->on('WorkerStart', array($this, 'onWorkerStart')); 
		$this->serv->on('Connect', array($this, 'onConnect')); 
		$this->serv->on('Receive', array($this, 'onReceive')); 
		$this->serv->on('Close', array($this, 'onClose')); 
		$this->serv->on('Finish', array($this, 'onFinish')); 
		$this->serv->start(); 
	} 

	public function onStart($serv) { 
		echo "Start\n"; 
	} 

	public function onWorkerStart($serv, $worker_id){
		// 只有taskworker 初始化pdo
		if( $worker_id == 0 ) {
			// swoole_timer_tick(1000, function($timer_id,$params){
			// 	echo "timer running\n";
			// 	echo "recv: {$params}\n";
			// },"Hello ");
				//timer传入值方法
			$this->test=new test();
			$this->test->index=1;
			$timer_id=swoole_timer_tick(1000, array($this, 'onTick') ,"Hello ");
			var_dump($timer_id);
		}
			
	}

	public function onTick($timer_id,$params){
		//timer传入值方法
		var_dump($this->test->index);
		echo "timer running\n";
		echo "recv: {$params}\n";
	}

	public function onConnect($serv, $fd, $from_id) { 
		$serv->send($fd, "Hello {$fd}!"); 
	} 
	
	// 
	public function onReceive(swoole_server $serv, $fd, $from_id, $data) { 
		echo "Get Message From Client {$fd}:{$data}\n"; 
		// 在收到信息后延迟返回信息（仅执行一次）
		swoole_timer_after(1000, function() use($serv, $fd){
			echo "timer after\n";
			$serv->send($fd,"hello later\n");
		});
	} 

	public function onClose($serv, $fd, $from_id) { 
		echo "Client {$fd} close connection\n"; 
	} 


	public function onFinish($serv, $task_id, $data){
		echo "finish get from {$task_id} data {$data}\n";
	}

} 

// 启动服务器 
$server = new Server(); 


?>