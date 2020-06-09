<?php 
class Crontab {
	
	// In this class, array instead of string would be the standard input / output format.
	
	// Legacy way to add a job:
	// $output = shell_exec('(crontab -l; echo "'.$job.'") | crontab -');
	
	static private function stringToArray($jobs = '') {
		$array = preg_split ('/$\R?^/m', trim($jobs));
		//$array = explode("\r\n", trim($jobs)); // trim() gets rid of the last \r\n
		$newArray = array();
		foreach ($array as $key => $item) {
			if ($item != '') {
				$newArray[] = $item;
			}
		}
		return $newArray;
	}
	
	static private function arrayToString($jobs = array()) {
		$string = implode(PHP_EOL, $jobs);
		return $string;
	}
	
	static public function getJobs() {
		if(set_shell_type==1){
			$output = exec(set_shell_command.' -l');
		}else{
			$output = shell_exec(set_shell_command.' -l');
		}
		
		return self::stringToArray($output);
	}
	
	static public function saveJobs($jobs = array()) {
		
		if(set_shell_type==1){
			$output = exec('echo "'.self::arrayToString($jobs).'" | '.set_shell_command);
		}else{
			$output = shell_exec('echo "'.self::arrayToString($jobs).'" | '.set_shell_command);
		}
		
		return $output;	
	}
	
	static public function doesJobExist($job = '') {
		$jobs = self::getJobs();
		if (in_array($job, $jobs)) {
			return true;
		} else {
			return false;
		}
	}
	
	static public function addJob($job = '') {
		if (self::doesJobExist($job)) {
			return false;
		} else {
			$jobs = self::getJobs();
			$jobs[] = $job;
			return self::saveJobs($jobs);
		}
	}
	
	static public function removeJob($job = '') {
		if (self::doesJobExist($job)) {
			$jobs = self::getJobs();
			unset($jobs[array_search($job, $jobs)]);
			return self::saveJobs($jobs);
		} else {
			return false;
		}
	}
	
}
?>