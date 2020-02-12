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
		    	//$sql = "SELECT * FROM `items` WHERE category_id = '$catId'";
		    	$sqll = "SELECT * FROM `categories` WHERE id in ($catId)";
		    	$resultt = mysql_query($sqll);
		    	while($catRow = mysql_fetch_array($resultt)){
		    	$type=$catRow['type'];
		    	}
		    	if($type=='Commercial')
		    	$sql = "SELECT * FROM `items` WHERE category_id = '$catId' ORDER BY order_no,id";
		    	else
		    	$sql = "SELECT * FROM `items` WHERE category_id in ($catId) ORDER BY category_id,sort_no";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
    
	public function searchItems($name){
    	if($this->connection->getConnection()){
		    	//$sql = "SELECT * FROM `items` WHERE name LIKE '%$name%'";
		    	$sql = "SELECT * FROM `items` WHERE name LIKE '%$name%' or description like '%$name%' or email like '%$name%' or website like '%$name%' or location like '%$name%'";

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
		    	$sql = "SELECT * FROM `items` WHERE category_id = 15 or category_id = 16";
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
				$sqldel = "INSERT INTO deleted_data (data_id,table_name)VALUES ($id,'items')";
				$resultdel = mysql_query($sqldel);
				$sql = "DELETE FROM `items` WHERE id ='$id'";
				$result = mysql_query($sql);
				
				return true;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function insertItem($catId, $name, $description, $phone, $email, $website, $location, $address2,$latitude, $longitude, $date) {
    	if($this->connection->getConnection()){
                               // $name=mysql_escape_string($name);
    			//	mysql_query('SET CHARACTER SET utf8');
    				//$desc = mysql_real_escape_string($description);
				$q="SELECT * from items where category_id=$catId";
    			$resultss = mysql_query($q);
    			$results = mysql_num_rows($resultss);
    			$results=$results+1;
			    	$sql = "INSERT INTO items ( category_id, name, description,phone,email,website,location, address2,latitude,lognitude,created_at,sort_no) VALUES ('$catId', '$name', '$description', '$phone', '$email', '$website', '$location', '$address2', '$latitude', '$longitude', '$date','$results')";
			    	$result = mysql_query($sql);
			    	return $result;
 		}else {
				die("Could not connect to the database");
		} 
    }
	public function updateItem($catId, $name, $description, $phone, $email, $website , $location, $address2,$latitude, $longitude, $id){
		if($this->connection->getConnection()){
	 			//$name=mysql_escape_string($name);
    				//mysql_query('SET CHARACTER SET utf8');
    				//$desc = mysql_real_escape_string($description);
					$sql = "UPDATE items SET category_id='$catId',name='$name',description ='$description',phone = '$phone',email = '$email',website = '$website', location='$location', address2='$address2',latitude = '$latitude',  lognitude='$longitude' WHERE id='$id'";
					$result = mysql_query($sql);

					return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	

/**
 * To fetch complete data from table:categories
 * @return complete rows
 */	
	function fetchCompleteCategories() {
		if ($this->connection->getConnection()){
			$qry_Categories = mysql_query("SELECT * FROM categories ORDER BY id");
			
			return $qry_Categories;
		} else {
			die("Database connection Error");
		}
	}
	
	
/**
 * To fetch complete data from table:items
 * @return complete rows
 */	
	function fetchAllItems() {
		if ($this->connection->getConnection()){
			$fetchWholeResult = mysql_query("SELECT * FROM items ORDER BY id");
			
			return $fetchWholeResult;
		} else {
			die("Database connection Error");
		}
	}

	function selectItemsrandom($cid, $subtype)
{
if ($this->connection->getConnection()){
$query=mysql_query("SELECT * from items");
while($row = mysql_fetch_array($query))
{
$num = rand() % 33;
$id=$row['id'];
$qry = mysql_query("UPDATE items set order_no=$num where id=$id");

}
return $qry;
		} else {
			die("Database connection Error");
		}
}
function moveupItems($cid,$subtype,$item_id)	
{
	if ($this->connection->getConnection()){
$selectquery=mysql_query("SELECT * from items where id=$item_id");
//echo $qq=mysql_num_rows($q);
while($row = mysql_fetch_array($selectquery))
{
$sortno=$row['sort_no'];
$updateitem_id=$row['category_id'];
if($sortno==1)
{
$num=1;
$qry = mysql_query("UPDATE items set sort_no=$num where id=$item_id");
return $qry;
}
else
{
$num=$sortno-1;
$qry = mysql_query("UPDATE items set sort_no=$num where id=$item_id");


}
$query=mysql_query("SELECT * from items where sort_no=$num and id!=$item_id and category_id=$updateitem_id");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num+1;
$updatequery = mysql_query("UPDATE items set sort_no=$updatenum where id=$newid");


}
return $updatequery;
}
	} else {
			die("Database connection Error");
		}
}

function movedownItems($cid,$subtype,$item_id)	
{
if ($this->connection->getConnection()){
$countqry=mysql_query("SELECT * from items where category_id=$cid");
$count=mysql_num_rows($countqry);
$selectquery=mysql_query("SELECT * from items where id=$item_id");
while($row = mysql_fetch_array($selectquery))
{
$sort_no=$row['sort_no'];
$updateitem_id=$row['category_id'];
if($sort_no==$count)
{
$num=$count;
$qry = mysql_query("UPDATE items set sort_no=$num where id=$item_id");
return $qry;
}
else
{
$num=$sort_no+1;
$qry = mysql_query("UPDATE items set sort_no=$num where id=$item_id");
//$arr = mysql_fetch_array($qry);

}
$query=mysql_query("SELECT * from items where sort_no=$num and id!=$item_id and category_id=$updateitem_id");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num-1;
$updatequery = mysql_query("UPDATE items set sort_no=$updatenum where id=$newid");
//$array = mysql_fetch_array($qryy);

}
return $updatequery;
}
	} else {
			die("Database connection Error");
		}
}
	
public function fetchItemsnimages($subcat_id) {
		if ($this->connection->getConnection()){
			$fetchWholeResult = mysql_query("SELECT * FROM items JOIN item_images where items.id=item_images.item_id and items.category_id=$subcat_id");
			
			return $fetchWholeResult;
		} else {
			die("Database connection Error");
		}
	}

public function fetchAllItemsUpdated($date) {
		if ($this->connection->getConnection()){
			$fetchWholeResult = mysql_query("SELECT * FROM items where updated_at>'$date' and created_at<'$date'");
			
			return $fetchWholeResult;
		} else {
			die("Database connection Error");
		}
	}


public function fetchAllItemsCreated($date) {
		if ($this->connection->getConnection()){
			$fetchWholeResult = mysql_query("SELECT * FROM items where created_at>'$date'");
			
			return $fetchWholeResult;
		} else {
			die("Database connection Error");
		}
	}	

public function getItemsNew($subid,$catId){
    	if($this->connection->getConnection()){
		    	//$sql = "SELECT * FROM `items` WHERE category_id = '$catId'";
		    	$sqll = "SELECT * FROM `categories` WHERE id = '$catId'";
		    	$resultt = mysql_query($sqll);
		    	while($catRow = mysql_fetch_array($resultt)){
		    	$type=$catRow['type'];
		    	}
		    	if($type=='Commercial')
		    	$sql = "SELECT * FROM `items` WHERE category_id = '$catId' or  category_id = '$subid' ORDER BY order_no";
		    	else
		    	$sql = "SELECT * FROM `items` WHERE category_id = '$catId' ORDER BY sort_no";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
public function moverestItems($cat_id,$id) {
    	if($this->connection->getConnection()){
    		$selectquery=mysql_query("SELECT * from items where id=$id");
			while($row = mysql_fetch_array($selectquery))
			{
			$sort_no=$row['sort_no'];
			$subcat_id=$row['category_id'];
			}
    		 $query=mysql_query("SELECT * from items where category_id=$subcat_id and sort_no > $sort_no");
    	while($rows = mysql_fetch_array($query))
		{
		$num=$rows['sort_no'];
		$newid=$rows['id'];
		$updatenum=$num-1;
		$updatequery = mysql_query("UPDATE items set sort_no=$updatenum where id=$newid");

		}
			    	
 		}else {
				die("Could not connect to the database");
		} 
    }

public function updatetrailno($trail_no,$id) {
    	if($this->connection->getConnection()){
    		
		$updatequery = mysql_query("UPDATE items set trail_no=$trail_no where id=$id");
		
			    	
 		}else {
				die("Could not connect to the database");
		} 
    }
function __distruct() {
		//Close Connection
		$this->connection->close();
	}
}
