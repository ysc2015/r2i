<?php
/**
 * PDO Wrapper class.
 * @author RR
 */

class DB extends PDO {
	/**
	 * Database Instance
	 * @var PDO object
	 * @access private
	 */
	private static $instance = null;

	/**
	 * Error string
	 * @var string
	 * @access private
	 */
	private $error;

	/**
	 * SQL Statment
	 * @var string
	 * @access private
	 */
	private $sql;


	/**
	 * Bind parameters
	 * @var array
	 * @access private
	 */
	private $bind;

	/**
	 * Error callback function name
	 * @var string
	 * @access private
	 */
	private $errorCallbackFunction;

	/**
	 * Error message format
	 * @var string
	 * @access private
	 */
	private $errorMsgFormat;


	/**
	 * Constructor function.
	 */
	public function __construct() {
		$options = array(
			PDO::ATTR_PERSISTENT => true, 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION/*,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET collation_connection = utf8_bin;SET NAMES utf8;"*/
		);

		try {
			parent::__construct("mysql:host=127.0.0.1;port=3306;dbname=r2i", "r2i", "r2i",$options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	/**
	 * get DB instance
	 * @return PDO object
	 */
	public static function getInstance()
	{
		if (!self::$instance)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * clone object
	 */
	private function __clone(){}

	/**
	 * Debug function
	 */
	private function debug() {
		if(!empty($this->errorCallbackFunction)) {
			$error = array("Error" => $this->error);
			if(!empty($this->sql))
				$error["SQL Statement"] = $this->sql;
			if(!empty($this->bind))
				$error["Bind Parameters"] = trim(print_r($this->bind, true));

			$backtrace = debug_backtrace();
			if(!empty($backtrace)) {
				foreach($backtrace as $info) {
					if($info["file"] != __FILE__)
						$error["Backtrace"] = $info["file"] . " at line " . $info["line"];	
				}		
			}

			$msg = "";
			if($this->errorMsgFormat == "html") {
				if(!empty($error["Bind Parameters"]))
					$error["Bind Parameters"] = "<pre>" . $error["Bind Parameters"] . "</pre>";
				$css = trim(file_get_contents(dirname(__FILE__) . "/error.css"));
				$msg .= '<style type="text/css">' . "\n" . $css . "\n</style>";
				$msg .= "\n" . '<div class="db-error">' . "\n\t<h3>SQL Error</h3>";
				foreach($error as $key => $val)
					$msg .= "\n\t<label>" . $key . ":</label>" . $val;
				$msg .= "\n\t</div>\n</div>";
			}
			elseif($this->errorMsgFormat == "text") {
				$msg .= "SQL Error\n" . str_repeat("-", 50);
				foreach($error as $key => $val)
					$msg .= "\n\n$key:\n$val";
			}

			$func = $this->errorCallbackFunction;
			$func($msg);
		}
	}

	/**
	 * Delete row from DB table
	 * @param string $table table name
	 * @param string $where where clause
	 * @param string $bind bind parameters
	 * @return array|bool|int
	 */
	public function delete($table, $where, $bind="") {
		$sql = "DELETE FROM " . $table . " WHERE " . $where . ";";
		$this->run($sql, $bind);
	}

	/**
	 * Filter a DB table
	 * @param string $table table name
	 * @param string $info schema infos
	 * @return array
	 */
	private function filter($table, $info) {
		$driver = $this->getAttribute(PDO::ATTR_DRIVER_NAME);
		if($driver == 'sqlite') {
			$sql = "PRAGMA table_info('" . $table . "');";
			$key = "name";
		}
		elseif($driver == 'mysql') {
			$sql = "DESCRIBE " . $table . ";";
			$key = "Field";
		}
		else {	
			$sql = "SELECT column_name FROM information_schema.columns WHERE table_name = '" . $table . "';";
			$key = "column_name";
		}	

		if(false !== ($list = $this->run($sql))) {
			$fields = array();
			foreach($list as $record)
				$fields[] = $record[$key];
			return array_values(array_intersect($fields, array_keys($info)));
		}
		return array();
	}

	/**
	 * return array format
	 * @param array $bind to bind array
	 * @return array
	 */
	private function cleanup($bind) {
		if(!is_array($bind)) {
			if(!empty($bind))
				$bind = array($bind);
			else
				$bind = array();
		}
		return $bind;
	}

	/**
	 * Insert row into DB table
	 * @param string $table table name
	 * @param string $info schema infos
	 * @return array|bool|int
	 */
	public function insert($table, $info) {
		$fields = $this->filter($table, $info);
		$sql = "INSERT INTO " . $table . " (" . implode($fields, ", ") . ") VALUES (:" . implode($fields, ", :") . ");";
		$bind = array();
		foreach($fields as $field)
			$bind[":$field"] = $info[$field];
		return $this->run($sql, $bind);
	}

	/**
	 * Run SQL statment
	 * @param string $sql sql request
	 * @param array $bind bind parameters
	 * @return array|bool|int
	 */
	public function run($sql, $bind="") {
		$this->sql = trim($sql);
		$this->bind = $this->cleanup($bind);
		$this->error = "";

		try {
			$this->exec("SET collation_connection = utf8_bin; SET NAMES utf8;");
			$pdostmt = $this->prepare($this->sql);
			if($pdostmt->execute($this->bind) !== false) {
				if(preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $this->sql))
					return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
				elseif(preg_match("/^(" . implode("|", array("delete", "insert", "update")) . ") /i", $this->sql))
					return $pdostmt->rowCount();
			}	
		} catch (PDOException $e) {
			$this->error = $e->getMessage();	
			$this->debug();
			return false;
			//return $this->sql;
		}
	}

	/**
	 * Select row(s) from DB table
	 * @param string $table table name
	 * @param string $where where clauses
	 * @param array $bind bind parameters
	 * @param string $fields fields to select
	 * @return array|bool|int
	 */
	public function select($table, $where="", $bind="", $fields="*") {
		$sql = "SELECT " . $fields . " FROM " . $table;
		if(!empty($where))
			$sql .= " WHERE " . $where;
		$sql .= ";";
		return $this->run($sql, $bind);
	}

	/**
	 * Set error callback function
	 * @param string $errorCallbackFunction error callback function to call
	 * @param $errorMsgFormat error message format
	 */
	public function setErrorCallbackFunction($errorCallbackFunction, $errorMsgFormat="html") {
		//Variable functions for won't work with language constructs such as echo and print, so these are replaced with print_r.
		if(in_array(strtolower($errorCallbackFunction), array("echo", "print")))
			$errorCallbackFunction = "print_r";

		if(function_exists($errorCallbackFunction)) {
			$this->errorCallbackFunction = $errorCallbackFunction;	
			if(!in_array(strtolower($errorMsgFormat), array("html", "text")))
				$errorMsgFormat = "html";
			$this->errorMsgFormat = $errorMsgFormat;	
		}	
	}

	/**
	 * Update row(s) from DB table
	 * @param string $table table name
	 * @param string $info schema infos
	 * @param string $where where clauses
	 * @param array $bind bind parameters
	 * @return array|bool|int
	 */
	public function update($table, $info, $where, $bind="") {
		$fields = $this->filter($table, $info);
		$fieldSize = sizeof($fields);

		$sql = "UPDATE " . $table . " SET ";
		for($f = 0; $f < $fieldSize; ++$f) {
			if($f > 0)
				$sql .= ", ";
			$sql .= $fields[$f] . " = :update_" . $fields[$f]; 
		}
		$sql .= " WHERE " . $where . ";";

		$bind = $this->cleanup($bind);
		foreach($fields as $field)
			$bind[":update_$field"] = $info[$field];
		
		return $this->run($sql, $bind);
	}
}// END class
?>