<?php
class ItemImage{
	
	
	/**
		@constructor
	**/
	function ItemImage($connection) {
    	$this->connection =  $connection;
    	
    }
     
	public function insertImagenew($id,$filename,$captions){
		if($this->connection->getConnection()){
		$this->id = $id;
		$this->filename = $filename;
		$this->caption = $captions;
		$sql = "INSERT INTO item_images (item_id, image,caption)VALUES ('$this->id','$this->filename','$this->caption' )";
		$result = mysql_query($sql);
		
		return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function countImagenew($itemId){
		if($this->connection->getConnection()){
		$sql = "SELECT COUNT(*) as Num_images FROM item_images WHERE item_id = $itemId";
		$result = mysql_query($sql);
		return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function getImg($itemId){
		if($this->connection->getConnection()){
		$sql = "SELECT * FROM item_images WHERE item_id = $itemId";
		$result = mysql_query($sql);
		return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function updateImage($id,$caption,$image){
		
		if($this->connection->getConnection()){
			$sql = "UPDATE item_images SET caption = '$caption',image = '$image' WHERE id='$id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function updateImageNew($id,$caption){
		
		if($this->connection->getConnection()){
			$sql = "UPDATE item_images SET caption = '$caption' WHERE id='$id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function getImgByPk($id){
		if($this->connection->getConnection()){
		$sql = "SELECT * FROM item_images WHERE id = $id";
		$result = mysql_query($sql);
		return $result;
		}else {
				die("Could not connect to the database");
		}
	}
    
	public function deleteImg($id){
		if($this->connection->getConnection()){
                $sqldel = "INSERT INTO deleted_data (data_id,table_name)VALUES ($id,'item_images')";
		$resultdel = mysql_query($sqldel);
		$sql = "DELETE FROM item_images WHERE id = $id";
		$result = mysql_query($sql);
		return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
public function getOfflineImages(){
		if($this->connection->getConnection()){
		$sql = "SELECT * FROM item_images WHERE offline_status=1";
		$result = mysql_query($sql);
		return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
	
public function updateOfflineStatus($cat_id){
		
		if($this->connection->getConnection()){
			$sql = "update item_images join items set item_images.offline_status=0 WHERE item_images.item_id=items.id and items.category_id=$cat_id";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}	

	
public function setOfflineStatus($id){
		
		if($this->connection->getConnection()){
			$sql = "update item_images set offline_status=1 WHERE id=$id";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}


public function fetchAllImagesUpdated($date) {
		if ($this->connection->getConnection()){
			$fetchWholeResult = mysql_query("SELECT * FROM item_images where updated_at>'$date' and created_at<'$date'");
			
			return $fetchWholeResult;
		} else {
			die("Database connection Error");
		}
	}


public function fetchAllImagesCreated($date) {
		if ($this->connection->getConnection()){
			$fetchWholeResult = mysql_query("SELECT * FROM item_images where created_at>'$date'");
			
			return $fetchWholeResult;
		} else {
			die("Database connection Error");
		}
	}	

public function uploadimages(){
		if($this->connection->getConnection()){
		error_reporting(E_ALL);
 		ini_set('display_errors', '1');
		//$sql = "SELECT * FROM item_images where image!='05172013071054CBT 1.jpg' LIMIT 600,100";
		$sql = "SELECT * FROM item_images where image='10142013074643x on st john.jpg'";
		$result = mysql_query($sql);
		while($rowResult = mysql_fetch_array($result))
		{
			
			$source_url="upload/".$rowResult['image'];
			$destination_url="compress/".$rowResult['image'];	
			 $info = getimagesize($source_url); 
						if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url); 
						elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url); 
						elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url); 
						imagejpeg($image, $destination_url, 50);
		}
		}else {
				die("Could not connect to the database");
		}
	}

	function __distruct() {
		//Close Connection
		$this->connection->close();
	}
}
