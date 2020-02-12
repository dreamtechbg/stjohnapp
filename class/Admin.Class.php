<?php
Class Admin{
	private $user;
	
	private $userName;
	
	private $password;
	
	private $adminname;
	
	private $adminemail;
	
	private $newPass;
	
	private $date;
	
	private $id;
	

	/**
		@constructor
	**/
	function Admin($connection) {
    	$this->connection =  $connection;
    	
    }
	
	public function adminLoginCkeck($username,$password){
		if($this->connection->getConnection()){
		    	$this->userName = $username;
		    	$this->password = $password;	
				$sql = "select password from admin where username like binary '$this->userName'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				$returnPass =	$row['password']; 	
				if($returnPass == $password){ 			
				return $result;
				}  	
		}else {
				die("Could not connect to the database");
		}
    }
    public function adminDetails($user){
    	if($this->connection->getConnection()){
		    	$this->user =  $user;
		    	$sql = "SELECT * FROM `admin` WHERE username = '$this->user'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    public function updateAdmin($adminname,$adminemail,$id){
	
    	if($this->connection->getConnection()){				
		    	$this->id = $id;
		    	$this->adminname = $adminname;
		    	$this->adminemail = $adminemail;
				
		    	$sql = "UPDATE admin SET name='$this->adminname', email='$this->adminemail' WHERE id=$this->id";
		    	$result = mysql_query($sql);
		    					
		    	return true;
    	}else {
				die("Could not connect to the database");
		}
    }
    public function getPassword($id){
    	if($this->connection->getConnection()){
		    	$this->id = $id;
		    	$sql = "SELECT * FROM `admin` WHERE id ='$id'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    }
	public function updatePassword($newPass,$date,$id){
		if($this->connection->getConnection()){
		    	$this->id = $id;
		    	$this->newpass = $newPass;
		    	$this->date = $date;
		    	$sql = "UPDATE `admin` SET password='$this->newpass',created_at='$this->date' WHERE id ='$this->id'";
		    	$result = mysql_query($sql);
		    	
		    	return true;
		}else {
				die("Could not connect to the database");
		}
    }
 	public function adminEmail($email){
 		
 		if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `admin` WHERE email ='$email'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
 		}else {
				die("Could not connect to the database");
		}
    
    }
	public function getAdminEmail(){
		
		if($this->connection->getConnection()){
		    	$sql = "SELECT email FROM `admin`";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
		}else {
				die("Could not connect to the database");
		}
    
    }
    
    
	function __distruct() {
		//Close Connection
		$this->connection->close();
	}
    
}