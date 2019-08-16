<?php
ini_set('display_errors',1);            //错误信息  
ini_set('display_startup_errors',1);    //php启动错误信息  
error_reporting(-1); 

class myProcess
{
	public function run($process_num)
	{
		try {
			if(function_exists('pcntl_fork'))
			{
				$ppid = posix_getpid();
				for($i = 0; $i < $process_num; $i++)
				{
					$pids = [];
					$pid = pcntl_fork();
					if($pid == -1)
					{
						throw new Exception("创建子进程失败", 1);
					}elseif($pid){
						//父进程
						$pids[] = $pid;
					}else{
						$this->process($ppid);
						exit; //这行代码不能删除
					}
				}

				// 等待子进程结束
	            foreach ($pids as $pid) {
	                pcntl_waitpid($pid, $status);
	            }
			}else{
				throw new Exception("当前PHP版本不支持pcntl_fork功能".PHP_EOL, 1);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function process($ppid)
	{
		try {
			//这里子进程的逻辑 TODO
			
			$cpid = posix_getpid();
			error_log("我是子进程，我的进程id是".$cpid."我的父id是".$ppid.PHP_EOL, 3, './success.log');
		    cli_set_process_title("phpProcess");
		    sleep(2);
		} catch (Exception $e) {
			//日志记录处理错误信息 $e->getMessage();
			error_log($e->getMessage(), 3, './errors.log');
			exit;
		}
	}
}

(new myProcess())->run(3);

?>
