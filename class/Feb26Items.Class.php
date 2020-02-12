<?php
class Items{
	
	
	/**
		@constructor
	**/
	function Items($connection) {
    	$this->connection =  $connection;
    	
    }
    
	public function getItems($catId){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE category_id = '$catId'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
    
	public function searchItems($name){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE name LIKE '%$name%'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
	public function searchByItems($array, $name){
		$ids = implode(",", $array);   
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE name LIKE '%$name%' AND category_id IN ($ids)";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
    
	public function getByLimit($catId,$limit,$start){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE category_id = '$catId' LIMIT $start, $limit";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
	public function search($category,$item){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE category_id = '$category' AND name LIKE '%$item%'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
    public function searchByItem($itemName){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE name LIKE '%$itemName%'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    }
    
	public function getCount($catId){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT COUNT(*) FROM `items` WHERE category_id = '$catId'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
    
	public function getMainTrail(){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE category_id = 15 ";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
	public function getItemsByPk($id){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `items` WHERE id = '$id'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
	public function deleteItem($id){
		if($this->connection->getConnection()){
				$sql = "DELETE FROM `items` WHERE id ='$id'";
				$result = mysql_query($sql);
				
				return true;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function insertItem($catId, $name, $description, $phone, $email, $website, $location, $latitude, $longitude, $date) {
    	if($this->connection->getConnection()){
    				mysql_query('SET CHARACTER SET utf8');
    				$desc = mysql_real_escape_string($description);
			    	$sql = "INSERT INTO items ( category_id, name, description,phone,email,website,location,latitude,lognitude,created_at ) VALUES ('$catId', '$name', '$desc', '$phone', '$email', '$website', '$location', '$latitude', '$longitude', '$date')";
			    	$result = mysql_query($sql);
			    	return $result;
 		}else {
				die("Could not connect to the database");
		} 
    }
	public function updateItem($catId, $name, $description, $phone, $email, $website, $location, $latitude, $longitude, $id){
		if($this->connection->getConnection()){
	
    				mysql_query('SET CHARACTER SET utf8');
    				$desc = mysql_real_escape_string($description);
					$sql = "UPDATE items SET category_id='$catId',name='$name',description ='$desc',phone = '$phone',email = '$email',website = '$website', location='$location', latitude = '$latitude',  lognitude='$longitude' WHERE id='$id'";
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