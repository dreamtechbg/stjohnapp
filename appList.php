<?php 
include_once("common.php");
include_once("class/About_app.Class.php");
$objIsland = new About_app($objConnection);
$result = $objIsland->getAllApps();
include 'header.php';?>
<div class="contentRight">
<h2 style="float:left;margin-left:250px;margin-top:20px;margin-bottom:10px;">About the app</h2>
<div style="float:right;margin-right:20px;margin-top:20px;margin-bottom:10px;"><a href="./addApp.php">Add New Item</a></div>
	<div class="topdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:50px;">Slno</div>
			<div class="subdiv" align="left" style="width:150px;">Title</div>
			<div class="subdiv" align="left" style="width:200px;" >Description</div>
                        <div class="subdiv" align="left" style="width:80px;">Sort</div>
			<div class="subdiv subdiv_2" align="left">Actions</div>
	</div>
	<?php  
	$i = 1;
	while($row = mysql_fetch_array($result)) {	
$notagsDescription = strip_tags($row['discription']);
$subdesc=substr($notagsDescription,0,50);?>
	<div  class="listtopdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:50px;"><?php echo $i;?></div>
			<div class="subdiv" align="left" style="width:150px;" ><?php echo $row['name'];?></div>
			<div class="subdiv" align="left" style="width:200px;height: 40px;overflow: hidden;" ><div class="subDivWrap">
					<?php echo $subdesc;?> <span>...</span>
				</div>
				</div>
<div class="subdiv" align="left" style="width:80px;"><a class="btnup" title="move up" href="aboutAppSort.php?id=<?php echo $row['id'];?>&sortid=1">&#8743;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btndown" title="move down" href="aboutAppSort.php?id=<?php echo $row['id'];?>&sortid=2">&#8744;</a></div>																

			<div class="subdiv subdiv_2" align="left">
				<a href="./viewApp.php?rowId=<?php echo $row['id'];?>">View</a>
				<a href="./editApp.php?rowId=<?php echo $row['id'];?>">Edit</a>
				<a href="./deleteApp.php?rowId=<?php echo $row['id'];?>" onclick="return confirm('Are you sure?')">Delete</a>
			</div>
	</div>	
	<?php $i++; }?>
</div>	
<?php include 'footer.php' ;?>
