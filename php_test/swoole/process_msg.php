<?php
/**
 * 创建子进程，并通过管道进行通信
 * 管道中默认传递消息大小是受到限制的（65535）
 * 同步io/异步io 
 * io多路复用
 * epoll本质是阻塞io，它的优点能同时处理大量socket连接
 *
 * process（子进程）===>消息队列
 * 
 */
class BaseProcess { 
	private $process; 
	public function __construct() { 
		//（ ，false,true）=>不需要重定向输入输出，开启管道
		$this->process = new swoole_process(array($this , 'run') , false ,true); 
		if(!$this->process->useQueue(123)){
			var_dump(swoole_strerror(swoole_errorno()));
			exit;
		}
		$this->process->start();

		while (true) {
			$data = $this->process->pop();
			echo "RECV:".$data.PHP_EOL;
		}
	} 

	// 子进程启动后执行的方法
	public function run($worker){
		swoole_timer_tick(1000,function($timer_id){
			static $index = 0;
			$index = $index + 1;
			// 向队列中推入信息
			$this->process->push("Hello");
			var_dump($index);
			if($index == 10 ){
				swoole_timer_clear($timer_id);
			}
		}); 
	}
} 

// 启动服务器 
new BaseProcess();
swoole_process::signal(SIGCHLD,function($sig){
	//必须为false，非阻塞模式
	while($ret=swoole_process::wait(false)){
		echo "PID={$ret['pid']}\n";
	}
});

?>