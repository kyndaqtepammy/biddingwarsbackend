<?php
	class Db_Functions{
		private $conn;
	
	function __construct(){
		require_once 'db_connect.php';
		//conncetting to db
		$db			= new  DB_Connect();
		$this->conn	= $db->connect();	
	}
	
	
	function __destruct(){}
	
	
	//storing new user. returns user details
	public function storeUser($name, $email, $password){
		$uuid		= uniqid('', true);
		$hash		= $this->hashSSHA($password);
		$encrypted_password	= $hash["encrypted"]; //encrypted password
		$salt		= $hash["salt"]; //salt
		
		$stmt->		= $this-conn->prepare("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at) VALUES(?, ?, ?, ?, ?, NOW())        ");
		$stmt->bind_param("sssss", $uuid, $name, $email, $encrypted_password, $salt);
		$result		= $stmt->execute();
		$stmt->close();
		
		if($result){
			$stmt		= $this->conn->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$user		= $stmt->get_result()->fetch_assoc();
			$stmt->close();
		
		return $user;	
		}else{
			return false;
		}
	}
	
	
	public function getUserByEmailAndPassword($email, $password){
		
	}
	
	
	
	
	
	
	
	}