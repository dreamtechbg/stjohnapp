<?php
class DeletedData{
	
	
	/**
		@constructor
	**/
	function DeletedData($connection) {
    	$this->connection =  $connection;
    	
    }
public function getDeletedData(){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM deleted_data";
			$result = mysql_query($sql);		 	
			 			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}

public function getDeletedItems(){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM deleted_data where table_name='items'";
			$result = mysql_query($sql);		 	
			 			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}

	
public function getDeletedApps(){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM deleted_data where table_name='about_island'";
			$result = mysql_query($sql);		 	
			 			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}	
	
public function getDeletedIslands(){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM deleted_data where table_name='about_app'";
			$result = mysql_query($sql);		 	
			 			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}		

	
public function getDeletedCategories(){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM deleted_data where table_name='categories'";
			$result = mysql_query($sql);		 	
			 			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}

public function getDeletedImages(){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM deleted_data where table_name='item_images'";
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
?>
