<?php

define('MY_DIR',__dir__."/../api/uploads/assets/");

class FileManager
{

	const ASSETS_PATH = MY_DIR;

	static function Files($var){
		$files = array();

		if(!isset($_FILES[$var])) {
			return $files;
		}

		/*
		//  
		if(!isset($_FILES[$var][0])) {
			$files[] = new File($_FILES[$var]);
			return $files;
		}
		*/

		$array = array();
		//if(isset($_FILES[$var])){
		foreach ($_FILES[$var] as $key => $value) {
			if(is_array($value)){
				foreach ($value as $k => $v) {
					$array[$k][$key] = $v;
				}
			}else{
				$array[0] = $_FILES[$var];
				break;
			}
		}
		//}

		foreach ($array as $key => $value) {
			$files[] = new File($value);
		}
		return $files;
	}


}

class File
{
	private $name;
	private $type;
	private $size;
	private $tmp_path;
	private $fake_name;

	public function __construct($arr){
		$this->name = $arr['name'];
		$this->type = $arr['type'];
		$this->size = $arr['size'];
		$this->tmp_path = $arr['tmp_name'];
	}

	public function __get($arg){
		return $this->$arg;
	}

	public function __toString(){
		return $this->name;
	}

	public function move(){
		if(function_exists("gettimeofday"))
			$this->fake_name = str_replace(' ', '_', microtime());
		else
			$this->fake_name = $this->name."_".time();
		return move_uploaded_file($this->tmp_path, FileManager::ASSETS_PATH.$this->fake_name);
	}

}