<?php
class Categories{
	
	
	/**
		@constructor
	**/
	function Categories($connection) {
    	$this->connection =  $connection;
    	
    }
    
 	public function getSubCategory($id){
    	if($this->connection->getConnection()){
             //   if($id==1)
    		$sql = "SELECT * FROM `categories` WHERE parent = '$id' ORDER BY sub_sortno";
    		//else
		    //	$sql = "SELECT * FROM `categories` WHERE parent = '$id' or id = '$id'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
	public function getInfoCat(){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` WHERE parent ='0' AND type = 'Informational' ORDER BY sort_no,type";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
	public function getComCat(){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` WHERE parent ='0' AND type = 'Commercial' ORDER BY sort_no,type";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
	public function deleteSubCat($id){
		if($this->connection->getConnection()){
				$sqldel = "INSERT INTO deleted_data (data_id,table_name)VALUES ($id,'categories')";
				$resultdel = mysql_query($sqldel);
				$sql = "DELETE FROM `categories` WHERE id ='$id'";
				$result = mysql_query($sql);
				
				return true;
		}else {
				die("Could not connect to the database");
		}
	}
	
	
	public function getSubCount($parentId){
		if($this->connection->getConnection()){
				$sql = "SELECT COUNT(*) as count FROM `categories` WHERE parent ='$parentId'";
				$result = mysql_query($sql);
				
				return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	
	public function getCatName($id){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` WHERE id ='$id'";
		    	$result = mysql_query($sql);
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
	public function updateCatName($id,$name){
    	if($this->connection->getConnection()){
		    	$sql = "UPDATE `categories` SET name = '$name' WHERE id ='$id'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
	
    public function getCatByType($type , $parent){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` WHERE type ='$type' AND parent = '$parent' ";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    
public function getCatByallType(){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` where parent=0 ORDER BY type,sort_no";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }

	public function getSubCatByParent($parent){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` WHERE parent = '$parent' ";
		    	$result = mysql_query($sql);
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
	public function insertSubCat($name,$type,$parent,$date) {
    	if($this->connection->getConnection()){
$query="SELECT * from categories where type='$type' and parent=$parent";
    			$results = mysql_query($query);
    			$count = mysql_num_rows($results);
    			$count=$count+1;
			    	$sql = "INSERT INTO categories ( name, type, parent,created_at,sort_no,sub_sortno) VALUES ('$name', '$type', '$parent','$date','$count','$count')";
			    	$result = mysql_query($sql);
			    	return $result;
 		}else {
				die("Could not connect to the database");
		} 
    }
    



public function movecategoryup($id,$type){
    	if($this->connection->getConnection()){
		    	$selectquery=mysql_query("SELECT * from categories where id=$id and type='$type' and parent=0");
		while($row = mysql_fetch_array($selectquery))
		{
			$sortno=$row['sort_no'];
if($sortno==1)
{
$num=1;
$qry = mysql_query("UPDATE categories set sort_no=$num where id=$id");
return $qry;
}
else
{
$num=$sortno-1;
$qry = mysql_query("UPDATE categories set sort_no=$num where id=$id");

}
$query=mysql_query("SELECT * from categories where sort_no=$num and id!=$id and type='$type' and parent=0");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num+1;
$updatequery = mysql_query("UPDATE categories set sort_no=$updatenum where id=$newid");


}
			
			return $updatequery;
		}
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }

    
public function movecategorydown($id,$type)	
{
if ($this->connection->getConnection()){
$countqry=mysql_query("SELECT * from categories where type='$type' and parent=0");
$count=mysql_num_rows($countqry);
$selectquery=mysql_query("SELECT * from categories where id=$id");
while($row = mysql_fetch_array($selectquery))
{
$sort_no=$row['sort_no'];
if($sort_no==$count)
{
$num=$count;
$qry = mysql_query("UPDATE categories set sort_no=$num where id=$id");
return $qry;
}
else
{
$num=$sort_no+1;
$qry = mysql_query("UPDATE categories set sort_no=$num where id=$id");

}
$query=mysql_query("SELECT * from categories where sort_no=$num and id!=$id and type='$type' and parent=0");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num-1;
$updatequery = mysql_query("UPDATE categories set sort_no=$updatenum where id=$newid");

}
return $updatequery;
}
	} else {
			die("Database connection Error");
		}
}

public function fetchCatTab(){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories`";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }
    


public function fetchTrailSub(){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` where name='Trails'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }

    
    
public function fetchCatTabUpdated($date){
    	if($this->connection->getConnection()){
    		
		    	$sql = "SELECT * FROM `categories` where updated_at>'$date' and created_at<'$date'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }

    
public function fetchCatTabCreated($date){
    	if($this->connection->getConnection()){
    		
		    	$sql = "SELECT * FROM `categories` where created_at>'$date'";
		    	$result = mysql_query($sql);
		    	
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }

public function movesubcategoryup($id,$subparent){
    	if($this->connection->getConnection()){
    		$date = date('Y-m-d H:i:s');
		    	$selectquery=mysql_query("SELECT * from categories where id=$id");
		while($row = mysql_fetch_array($selectquery))
		{
			$sortno=$row['sub_sortno'];
if($sortno==1)
{
$num=1;
$qry = mysql_query("UPDATE categories set sub_sortno=$num,updated_at='$date' where id=$id");
return $qry;
}
else
{
$num=$sortno-1;
$qry = mysql_query("UPDATE categories set sub_sortno=$num,updated_at='$date' where id=$id");

}
$query=mysql_query("SELECT * from categories where sub_sortno=$num and id!=$id and parent=$subparent");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num+1;
$updatequery = mysql_query("UPDATE categories set sub_sortno=$updatenum,updated_at='$date' where id=$newid");


}
			
			return $updatequery;
		}
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }

    
public function movesubcategorydown($id,$subparent)	
{
if ($this->connection->getConnection()){
	$date = date('Y-m-d H:i:s');
$countqry=mysql_query("SELECT * from categories where parent=$subparent");
$count=mysql_num_rows($countqry);
$selectquery=mysql_query("SELECT * from categories where id=$id");
while($row = mysql_fetch_array($selectquery))
{
$sort_no=$row['sub_sortno'];
if($sort_no==$count)
{
$num=$count;
$qry = mysql_query("UPDATE categories set sub_sortno=$num,updated_at='$date' where id=$id");
return $qry;
}
else
{
$num=$sort_no+1;
$qry = mysql_query("UPDATE categories set sub_sortno=$num,updated_at='$date' where id=$id");

}
$query=mysql_query("SELECT * from categories where sub_sortno=$num and id!=$id and parent=$subparent");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num-1;
$updatequery = mysql_query("UPDATE categories set sub_sortno=$updatenum,updated_at='$date' where id=$newid");

}
return $updatequery;
}
	} else {
			die("Database connection Error");
		}
}    
    
    
public function getSubCatByParentSorted($parent){
    	if($this->connection->getConnection()){
		    	$sql = "SELECT * FROM `categories` WHERE parent = '$parent' ORDER BY sub_sortno";
		    	$result = mysql_query($sql);
		    	return $result;
    	}else {
				die("Could not connect to the database");
		}
    
    }


public function moverestMain($type,$parent,$id) {
    	if($this->connection->getConnection()){
    		$selectquery=mysql_query("SELECT * from categories where id=$id");
			while($row = mysql_fetch_array($selectquery))
			{
			$sort_no=$row['sort_no'];
			}

    		 $query=mysql_query("SELECT * from categories where type='$type' and parent=$parent and sort_no > $sort_no");
    	while($rows = mysql_fetch_array($query))
		{
		$num=$rows['sort_no'];
		$newid=$rows['id'];
		$updatenum=$num-1;
		$updatequery = mysql_query("UPDATE categories set sort_no=$updatenum where id=$newid");

		}
			    	
 		}else {
				die("Could not connect to the database");
		} 
    }


public function moverestSub($type,$parent,$id) {
    	if($this->connection->getConnection()){
    		$selectquery=mysql_query("SELECT * from categories where id=$id");
			while($row = mysql_fetch_array($selectquery))
			{
			$sort_no=$row['sub_sortno'];
			}
			//echo $q="SELECT * from categories where type='$type' and parent=$parent and sub_sortno > $sort_no";
    		 $query=mysql_query("SELECT * from categories where type='$type' and parent=$parent and sub_sortno > $sort_no");
    	while($rows = mysql_fetch_array($query))
		{
		$num=$rows['sub_sortno'];
		$newid=$rows['id'];
		$updatenum=$num-1;
		$updatequery = mysql_query("UPDATE categories set sub_sortno=$updatenum where id=$newid");

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
