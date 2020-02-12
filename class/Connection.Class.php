<?php

class Connection {
	
	private $userName;
	
	private $password;
	
	private $host;
	
	private $dataBase;
	
	private $connectionStatus;

/*    function Connection() {
    	
    }*/

    
    function configure($username, $password, $host, $dataBase) {    	
   
    	$this->userName = $username;
    	
    	$this->password = $password;
    	
    	$this->host = $host;
    	
    	$this->dataBase = $dataBase; 
    	
//    	$this->getConnection();
    }
    
    function getConnection() {
    	$connectionFlag = false;     	  
    	
    	try {
    		
				$this->connectionStatus = mysql_connect($this->host, $this->userName, $this->password);
						
				if($this->connectionStatus) {
					
					if (mysql_select_db($this->dataBase)) {
						// DATABASE CONNECTED
						$connectionFlag = true;
					}
				}			
			}	catch (Exception $e) {
				$connectionFlag = false;
				
				return $connectionFlag;
			}
			
			return $connectionFlag;
    }
    
    // Close existing connection
		function close() {
			try {
				if($this->connectionStatus) {
					mysql_close($this->connectionStatus);
				}
			}	catch(Exception $e) {}
		}
}
?>