<?php
class DataBase {
	private $host;
	private $user;	
	private $pass;
	private $db;
	private $sql_con;

	private static $_instance;

	private function __construct($host_sql) {
		$this->host = $host_sql['host'];	
		$this->user = $host_sql['user'];
		$this->pass = $host_sql['pass'];
		$this->db = $host_sql['db'];
		$this->sql_con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

		$sql_con = $this->sql_con;
		
		if (!$sql_con) {
			die("Can't connect to database");
		}
		
		mysqli_query($sql_con, 'SET NAMES utf8');
	}

	private function __clone() {}
	private function __wakeup() {}

	public static function get_instance($host_sql) {
		if(is_null(self::$_instance)) {
			self::$_instance = new self($host_sql);
		}

		return self::$_instance;
	}

	public static function escape_sql($str) {
		if (is_null($str)) {
			return 'NULL';
		}

		return "'".str_replace('\\', '\\\\', str_replace('\'', '\'\'', $str))."'";
	}

	public static function query($str) {
		$obj = self::$_instance;
		$sql_con = $obj->sql_con;

		$result = mysqli_query($sql_con, $str);

		if (!$result) {	
			die("SQL query error: ".mysqli_error($sql_con));
		}

		return $result;
	}

	public static function fetch_assoc ($query) {
		return mysqli_fetch_assoc($query);
	}

	public static function fetch_row ($query) {
		return mysqli_fetch_row($query);
	}

	public static function fetch_object ($query) {
		return mysqli_fetch_object($query);
	}
}