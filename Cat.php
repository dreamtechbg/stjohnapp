
<?php
include_once("common.php");
include_once("class/Categories.Class.php");
$objCat = new Categories($objConnection);
$type = $_REQUEST['type'];
if($type == 2){
$resultRow = $objCat->getInfoCat();
$resultRoww = $objCat->getInfoCat();
}
if($type == 3){
$resultRow = $objCat->getComCat();
$resultRoww = $objCat->getComCat();
}
include 'header.php';?>
<script type="text/javascript">
jQuery(document).ready(function(){	
	$('.pageContent .pageNav li:nth-child(<?php echo $_REQUEST['type']?>) ul').css('display','block');
});
</script>
<?php 
$heading = mysql_fetch_array($resultRoww);?>
<div class="contentRight">

<h2 style="float:left;margin-left:250px;margin-top:20px;margin-bottom:10px;"><?php echo $heading['type']?></h2>
<div style="float:right;margin-right:20px;margin-top:20px;margin-bottom:10px;"><a href="addCat.php?type=<?php echo $type;?>">Add New Item</a></div>
	<div class="topdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:50px;">Slno</div>
			<div class="subdiv" align="left" style="width:126px;">Name</div>
			<div class="subdiv" align="left" style="width:150px;" >Created at</div>
                        <div class="subdiv" align="left" style="width:80px;">Sort</div>
			<div class="subdiv" align="left" style="width:310px;" >Action</div>
   			
	</div>
	<?php  
	$i = 1;
	while($row = mysql_fetch_array($resultRow)) {	?>
	<div  class="listtopdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:50px;"><?php echo $i;?></div>
			<div class="subdiv" align="left" style="width:126px;" ><a href="./catList.php?catId=<?php echo $row['id']?>&type=<?php echo $type; ?>"><?php echo $row['name'];?></a></div>
			<div class="subdiv" align="left" style="width:150px;height: 40px;overflow: hidden;" ><?php echo $row['created_at'];?></div>
			<div class="subdiv" align="left" style="width:80px;"><a class="btnup" title="move up" href="sortcategory.php?id=<?php echo $row['id'];?>&subtype=<?php echo $type;?>&sortid=1">&#8743;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btndown" title="move down" href="sortcategory.php?id=<?php echo $row['id'];?>&subtype=<?php echo $type;?>&sortid=2">&#8744;</a></div>										


			<div class="subdiv subdiv_2" align="left"><a href="editmaincategory.php?rowId=<?php echo $row['id']?>&catId=<?php echo 0;?>&type=<?php echo $type;?>">Edit   </a>
			 <a href="deletemaincategories.php?rowId=<?php echo $row['id']?>&catId=<?php echo 0;?>&type=<?php echo $type;?>" onclick="return confirm('Are you sure?')">Delete</a></div>
	</div>	
	<?php $i++; }?>
</div>




<?php include 'footer.php' ;
?>
