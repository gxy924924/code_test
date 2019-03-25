<?php
/**
 * 创建子进程，并通过管道进行通信
 * 管道中默认传递消息大小是受到限制的（65535）
 * 同步io/异步io 
 * io多路复用
 * epoll本质是阻塞io，它的优点能同时处理大量socket连接
 *
 * process（子进程）
 * 基于c封装，方便php多进程编程
 * 内置管道、消息队列接口，可方便实现进程间通信
 * 提供自定义信号管理
 * 
 */
class BaseProcess { 
	private $process; 
	public function __construct() { 
		//（ ，false,true）=>不需要重定向输入输出，开启管道
		$this->process = new swoole_process(array($this , 'run') , false ,true); 
		// 是否转为守护进程
		// $this->process->daemon(true,true);
		$this->process->start();

		swoole_event_add($this->process->pipe, function ($pipe){
			$data = $this ->process->read();
			echo "RECV".$data.PHP_EOL;
		});
	} 

	// 子进程启动后执行的方法
	public function run($worker){
		swoole_timer_tick(1000,function($timer_id){
			static $index = 0;
			$index = $index + 1;
			// 向管道内写入hello
			$this->process->write("Hello");
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
	// var_dump(swoole_process::wait(false));
	// $ret=swoole_process::wait(false);
	while($ret=swoole_process::wait(false)){
		echo "PID={$ret['pid']}\n";
	}
});

?>