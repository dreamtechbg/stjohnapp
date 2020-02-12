<?php
class About_app{
	
	private $title;
	
	private $discription;
	
	private $date;
	
	private $id;
	
	/**
		@constructor
	**/
	function About_app($connection) {
    	$this->connection =  $connection;
    	
    }
	
	public function getAllApps(){
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM about_island ORDER BY sort_no";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}
	public function insertApp($title,$discription,$date){
		if($this->connection->getConnection()){
			$q="SELECT * from about_island";
    			$resultss = mysql_query($q);
    			$results = mysql_num_rows($resultss);
    			$results=$results+1;
			$this->title = $title;
			$this->discription = $discription;
			$this->date = $date;
			$sql = "INSERT INTO about_island (name, discription,created_at,sort_no)VALUES ('$this->title', '$this->discription','$this->date',$results)";
			$result = mysql_query($sql);
			$id = mysql_insert_id();
			return $id;
		}else {
				die("Could not connect to the database");
		}
		
	}
	public function updateApp($title, $discription,$id){
		if($this->connection->getConnection()){
			$this->id = $id;
			$this->title = $title;
			$this->discription = $discription;
			$sql = "UPDATE about_island SET name='$this->title',discription='$this->discription' WHERE id='$this->id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	public function getAppById($id){
		if($this->connection->getConnection()){
			$this->id = $id;
			$sql = "SELECT * FROM about_island WHERE id ='$this->id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}
	public function deleteApp($id){
		if($this->connection->getConnection()){
			$sqldel = "INSERT INTO deleted_data (data_id,table_name)VALUES ($id,'about_island')";
			$resultdel = mysql_query($sqldel);
			$this->id = $id;
			$sql = "DELETE FROM `about_island` WHERE id ='$this->id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	

 public function moveup($id){
		if($this->connection->getConnection()){
			
			$selectquery=mysql_query("SELECT * from about_island where id=$id");
		while($row = mysql_fetch_array($selectquery))
{
$sortno=$row['sort_no'];
if($sortno==1)
{
$num=1;
$qry = mysql_query("UPDATE about_island set sort_no=$num where id=$id");
return $qry;
}
else
{
$num=$sortno-1;
$qry = mysql_query("UPDATE about_island set sort_no=$num where id=$id");

}
$query=mysql_query("SELECT * from about_island where sort_no=$num and id!=$id");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num+1;
$updatequery = mysql_query("UPDATE about_island set sort_no=$updatenum where id=$newid");


}
			
			return $updatequery;
}
		}else {
				die("Could not connect to the database");
		}
		
	}
	
	
public function movedown($id)	
{
if ($this->connection->getConnection()){
$countqry=mysql_query("SELECT * from about_island");
$count=mysql_num_rows($countqry);
$selectquery=mysql_query("SELECT * from about_island where id=$id");
while($row = mysql_fetch_array($selectquery))
{
$sort_no=$row['sort_no'];
if($sort_no==$count)
{
$num=$count;
$qry = mysql_query("UPDATE about_island set sort_no=$num where id=$id");
return $qry;
}
else
{
$num=$sort_no+1;

$qry = mysql_query("UPDATE about_island set sort_no=$num where id=$id");
}
$query=mysql_query("SELECT * from about_island where sort_no=$num and id!=$id");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num-1;
$updatequery = mysql_query("UPDATE about_island set sort_no=$updatenum where id=$newid");

}
}
return $updatequery;
	echo"db";
	} else {
			die("Database connection Error");
		}
}

public function getAllAppsUpdated($date){
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sqlapp = "SELECT * FROM about_island where updated_at>'$date' and created_at<'$date'";
			$resultapp = mysql_query($sqlapp);
			
			return $resultapp;
		}else {
				die("Could not connect to the database");
		}
		
	}

public function getAllAppsCreated($date){
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sqlapp = "SELECT * FROM about_island where created_at>'$date'";
			$resultapp = mysql_query($sqlapp);
			
			return $resultapp;
		}else {
				die("Could not connect to the database");
		}
		
	}	
public function moverestApp($id) {
    	if($this->connection->getConnection()){
    		$selectquery=mysql_query("SELECT * from about_island where id=$id");
			while($row = mysql_fetch_array($selectquery))
			{
			$sort_no=$row['sort_no'];
			}
    		 $query=mysql_query("SELECT * from about_island where sort_no > $sort_no");
    	while($rows = mysql_fetch_array($query))
		{
		$num=$rows['sort_no'];
		$newid=$rows['id'];
		$updatenum=$num-1;
		$updatequery = mysql_query("UPDATE about_island set sort_no=$updatenum where id=$newid");

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
