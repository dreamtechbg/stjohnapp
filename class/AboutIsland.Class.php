<?php
class AboutIsland{
	
	private $id;
	
	
	/**
		@constructor
	**/
	function AboutIsland($connection) {
    	$this->connection =  $connection;
    	
    }
    
    
	public function getAboutIsland(){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "SELECT * FROM about_app ORDER BY sort_no";
			$result = mysql_query($sql);		 	
			 			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}
	public function getIslandById($id){
		if($this->connection->getConnection()){
			$this->id = $id;
			$sql = "SELECT * FROM about_app WHERE id ='$this->id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
		
	}
	public function updateIsland($title,$description,$id){
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sql = "UPDATE about_app SET name='$title',description='$description' WHERE id='$id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	public function deleteIsland($id){
		if($this->connection->getConnection()){
			$sqldel = "INSERT INTO deleted_data (data_id,table_name)VALUES ($id,'about_app')";
			$resultdel = mysql_query($sqldel);
			$this->id = $id;
			$sql = "DELETE FROM `about_app` WHERE id ='$this->id'";
			$result = mysql_query($sql);
			
			return $result;
		}else {
				die("Could not connect to the database");
		}
	}
	public function insertIsland($title,$discription,$date){
		if($this->connection->getConnection()){
			$q="SELECT * from about_app";
    			$resultss = mysql_query($q);
    			$results = mysql_num_rows($resultss);
    			$results=$results+1;
			$this->title = $title;
			$this->discription = $discription;
			$this->date = $date;
			$sql = "INSERT INTO about_app (name, description,created_at,sort_no)VALUES ('$this->title', '$this->discription','$this->date',$results)";
			$result = mysql_query($sql);
			$id = mysql_insert_id();
			return $id;
		}else {
				die("Could not connect to the database");
		}
		
	}
	

public function moveup($id){
		if($this->connection->getConnection()){
			
			$selectquery=mysql_query("SELECT * from about_app where id=$id");
		while($row = mysql_fetch_array($selectquery))
{
$sortno=$row['sort_no'];
if($sortno==1)
{
$num=1;
$qry = mysql_query("UPDATE about_app set sort_no=$num where id=$id");
return $qry;
}
else
{
$num=$sortno-1;
$qry = mysql_query("UPDATE about_app set sort_no=$num where id=$id");

}
$query=mysql_query("SELECT * from about_app where sort_no=$num and id!=$id");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num+1;
$updatequery = mysql_query("UPDATE about_app set sort_no=$updatenum where id=$newid");


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
$countqry=mysql_query("SELECT * from about_app");
$count=mysql_num_rows($countqry);
$selectquery=mysql_query("SELECT * from about_app where id=$id");
while($row = mysql_fetch_array($selectquery))
{
$sort_no=$row['sort_no'];
if($sort_no==$count)
{
$num=$count;
$qry = mysql_query("UPDATE about_app set sort_no=$num where id=$id");
return $qry;
}
else
{
$num=$sort_no+1;
$qry = mysql_query("UPDATE about_app set sort_no=$num where id=$id");

}
$query=mysql_query("SELECT * from about_app where sort_no=$num and id!=$id");
while($roww = mysql_fetch_array($query))
{
$newid=$roww['id'];
$updatenum=$num-1;
$updatequery = mysql_query("UPDATE about_app set sort_no=$updatenum where id=$newid");

}
return $updatequery;
}
	} else {
			die("Database connection Error");
		}
}


public function getAboutIslandUpdated($date){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sqlisl = "SELECT * FROM about_app where updated_at>'$date' and created_at<'$date'";
			$resultisl = mysql_query($sqlisl);		 	
			 			
			return $resultisl;
		}else {
				die("Could not connect to the database");
		}
		
	}

	
public function getAboutIslandCreated($date){
		
		if($this->connection->getConnection()){
			mysql_query('SET CHARACTER SET utf8');
			$sqlisl = "SELECT * FROM about_app where created_at>'$date'";
			$resultisl = mysql_query($sqlisl);		 	
			 			
			return $resultisl;
		}else {
				die("Could not connect to the database");
		}
		
	}

public function moverestIsland($id) {
    	if($this->connection->getConnection()){
    		$selectquery=mysql_query("SELECT * from about_app where id=$id");
			while($row = mysql_fetch_array($selectquery))
			{
			$sort_no=$row['sort_no'];
			}
    		 $query=mysql_query("SELECT * from about_app where sort_no > $sort_no");
    	while($rows = mysql_fetch_array($query))
		{
		$num=$rows['sort_no'];
		$newid=$rows['id'];
		$updatenum=$num-1;
		$updatequery = mysql_query("UPDATE about_app set sort_no=$updatenum where id=$newid");

		}
			    	
 		}else {
				die("Could not connect to the database");
		} 
    } 
	function __distruct() {
		//Close Connection
		$this->connection->close();
	}
	/*	public function updateAboutIsland($about_app, $date,$id){
		
		$this->id = $id;
		$this->about_app = $about_app;
		$this->date = $date;
		$sql = "UPDATE about_app SET about_app='$this->about_app',created_at='$this->date' WHERE id='$this->id'";
		$result = mysql_query($sql);
		
		return $result;
	} */
}
