<?php
/**
 * worker->task->pdo
 * worker进程发送信号到task进程并操控pdo
 * 
 */
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
			'task_worker_num' => 4 ,
		)); 
		// $this->serv->on('Start', array($this, 'onStart')); 
		$this->serv->on('WorkerStart', array($this, 'onWorkerStart')); 
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

	public function onWorkerStart($serv, $worker_id){
		// 只有taskworker 初始化pdo
		if($serv->taskworker){
			echo "onTaskWorkerStart\n";
			$this->pdo = new PDO(
				"mysql::host=localhost;port=3306;dbname=test",
				"root",
				"root",
				array(
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8';",
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_PERSISTENT => true ,
				)
			);
		}
			
	}

	public function onConnect($serv, $fd, $from_id) { 
		$serv->send($fd, "Hello {$fd}!"); 
	} 
	
	// task使用
	public function onReceive(swoole_server $serv, $fd, $from_id, $data) { 
		echo "Get Message From Client {$fd}:{$data}\n"; 
		if($data == 'insert'){
			$sql='insert into test1 (num) values (111)';
			$type=1;
		}else if($data == 'select'){
			$sql='select * from test1';
			$type=2;
		}else{
			$flag=1;
		}
		if(empty($flag)){
			$data_send = array(
				'type' => $type,
				'sql' => $sql,
				'params' => $data,
				'fd' => $fd,
			);
			$serv->task(json_encode($data_send));
		}
	} 

	public function onClose($serv, $fd, $from_id) { 
		echo "Client {$fd} close connection\n"; 
	} 

	public function onTask($serv, $task_id, $fd, $data) { 
		try{
			echo "this task {$task_id} from {$fd}\n";
			echo "Data: {$data}\n";
			$data=json_decode($data,1);
			$sql=$data['sql'];
			$statement = $this->pdo->prepare($data['sql']);
			$res=$statement->execute();
			if($data['type']==2){
				$res = $statement->fetchAll();
			}
			echo "res:\n";
			var_dump($res);
			return 'true';
		}catch(PDOException $e){
			var_dump($e);
			return 'false';
		}
		// sleep(8);
		
	}

	public function onFinish($serv, $task_id, $data){
		echo "finish get from {$task_id} data {$data}\n";
	}

} 

// 启动服务器 
$server = new Server(); 


?>