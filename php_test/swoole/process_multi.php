<?php
/**
 * 创建子进程，并通过管道进行通信
 * 动态进程池
 * 
 */
class BaseProcess { 
	// 父进程
	private $process; 
	// 子进程列表
	private $process_list = array();
	private $process_use = array();
	private $min_worker_num = 3;
	private $max_worker_num = 6;

	private $current_num;

	public function __construct() { 
		//（ ，false,true）=>不需要重定向输入输出，开启管道
		$this->process = new swoole_process(array($this , 'run') , false ,2); 
		$this->process->start();
		
		swoole_process::wait();
	} 

	// 子进程启动后执行的方法 
	public function run($worker){
		$this->current_num = $this->min_worker_num;

		for ($i=0; $i < $this->current_num ; $i++) { 
			$process = new swoole_process(array($this , 'task_run') , false ,2);
			$pid = $process->start();
			// 将子进程存入列表
			$this->process_list[$pid] = $process;
			$this->process_use[$pid] = 0;
		}
		// 批量给子进程添加回调
		foreach ($this->process_list as $process) {
			swoole_event_add($process->pipe,function ($pips) use($process){
				$data = $process -> read();
				var_dump($data);
				// 进程空闲标记
				$this->process_use[$data] = 0;
			});
		}

		// 通过tick每秒钟发一次任务
		swoole_timer_tick(1000,function($timer_id){
			static $index = 0;
			$index = $index + 1;
			$flag = true;
			// 查看是否有空闲进程，并发送任务给空闲进程
			foreach ($this->process_use as $pid => $used) {
				if($used == 0){
					$flag = false;
					$this->process_use[$pid] = 1;
					$this->process_list[$pid] ->write($index."Hello");
					break;
				}
			}
			// 如果没有空闲进程，判断是否进程数达到最大数，未达到则创建新进程，并赋予新任务
			if( $flag && $this->current_num < $this->max_worker_num ){
				var_dump('add_process');
				$process = new swoole_process(array($this , 'task_run') , false ,2); 
				$pid = $process->start();
				$this->process_list[$pid] = $process;
				$this->process_use[$pid] = 1;
				$this->process_list[$pid] ->write($index."Hello");
				$this->current_num ++;
			}
			var_dump($index);
			if($index == 10){
				foreach ($this->process_list as  $process) {
					$process->write('exit');
				}
				swoole_timer_clear($timer_id);
				$this->process->exit();
			}
		}); 
	}

	public function task_run($worker){
		swoole_event_add($worker->pipe, function($pipe) use ($worker){
			$data = $worker->read();
			var_dump($worker->pid . ":".$data);
			if($data == 'exit'){
				$worker->exit();
				exit();
			}
			sleep(5);
			$worker ->write("".$worker->pid);
		});
	}
} 

// 启动服务器 
new BaseProcess();

// swoole_process::signal(SIGCHLD,function($sig){
// 	//必须为false，非阻塞模式
// 	while($ret=swoole_process::wait(false)){
// 		echo "PID={$ret['pid']}\n";
// 	}
// });

?>