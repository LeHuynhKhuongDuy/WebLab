<?php
	class DBController {
		private $host = "localhost";
		private $user = "User_webass";
		private $password = "123456";
		private $database = "webass";
		private $conn;
		
		function __construct() {
			$this->conn = $this->connectDB();
		}
		
		function connectDB() {
			$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
			return $conn;
		}
		
		function runQuery($query) {
			$result = mysqli_query($this->conn,$query);
			while($row=mysqli_fetch_assoc($result)) {
				$resultset[] = $row;
			}		
			if(!empty($resultset))
				return $resultset;
		}
		
		function runInsertQuery($query){
			return mysqli_query($this->conn,$query);
		}

		function numRows($query) {
			$result  = mysqli_query($this->conn,$query);
			$rowcount = mysqli_num_rows($result);
			return $rowcount;	
		}
	}

	class Cookies{
		public $expired_time = 300;

		function get_expired_time(){
			return $this->expired_time;
		}
	}
?>