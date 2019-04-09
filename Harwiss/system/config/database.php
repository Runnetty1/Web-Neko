<?php
class database{
	/*
		The data here is just for use in the dev environment.
		Make sure to never upload your acctual Database connection data publicly.
	*/
	public $host = "localhost";
	public $port = 3307;
	public $username = "root";
	public $password = ""; 
	public $db_name = "harwissdata";
	
	function getDb(){
		return  "mysql:host=$this->host;port=$this->port;dbname=$this->db_name;charset=utf8";
	}
}
?>
