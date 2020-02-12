
<?php
include_once("common.php");
include_once("class/Categories.Class.php");
$catId = $_REQUEST['catId'];
$type = $_REQUEST['type'];
$objAdmin = new Categories($objConnection);
//$subCat = $objAdmin->getSubCatByParent($catId);
$subCat = $objAdmin->getSubCatByParentSorted($catId);
$countCat =  mysql_num_rows($subCat);
include 'header.php';?>
<script type="text/javascript">
jQuery(document).ready(function(){	
	$('.pageContent .pageNav li:nth-child(<?php echo $_REQUEST['type']?>) ul').css('display','block');
});
</script>
<div class="contentRight">
		
		<div style="float:right;margin-right:20px;"><a href="./addSubCat.php?type=<?php echo $type;?>&catId=<?php echo $catId;?>">Add Sub Category</a></div><br/>
		<div style="float:right;margin-right:20px;margin-top:20px;margin-bottom:10px;"><a href="./catList.php?catId=<?php echo $catId;?>&type=<?php echo $type;?>">BACK</a></div><
		<div class="topdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:40px;">SlNo</div>
			<div class="subdiv" align="left" style="width:80px;">Category</div>
			<div class="subdiv" align="left" style="width:80px;" >Type</div>
			<div class="subdiv" align="left" style="width:80px;" >Parent</div>
			<div class="subdiv" align="left" style="width:80px;">Sort</div>
			<div class="subdiv subdiv_2" align="left">Actions</div>
		</div>
<?php
if($countCat)
{
		$slno = 0; 
		while($row = mysql_fetch_array($subCat)) { 
		$slno++;
		$subCatName = $objAdmin->getCatName($row['parent']);
		$resultName = mysql_fetch_array($subCatName);
		?>
		<div  class="listtopdiv" id="searchheader">
		
			<div class="subdiv" align="left" style="width:40px;"><?php echo $slno;?></div>
			<div class="subdiv" align="left" style="width:80px;" ><?php echo $row['name'];?></div>
			<div class="subdiv" align="left" style="width:80px;" ><?php echo $row['type'];?></div>
			<div class="subdiv" align="left" style="width:80px;"><?php echo $resultName['name'];?></div>
			<div class="subdiv" align="left" style="width:80px;"><a class="btnup" title="move up" href="sortsubcategory.php?id=<?php echo $row['id'];?>&subparent=<?php echo $catId;?>&sortid=1&subtype=<?php echo $type;?>">&#8743;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btndown" title="move down" href="sortsubcategory.php?id=<?php echo $row['id'];?>&subparent=<?php echo $catId;?>&sortid=2&subtype=<?php echo $type;?>">&#8744;</a></div>
			<div class="subdiv subdiv_2" align="left">
				<a href="./editCat.php?rowId=<?php echo $row['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>">Edit</a>
				<a href="./deleteCat.php?rowId=<?php echo $row['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>" onclick="return confirm('Are you sure?')">Delete</a>
		    </div>
		   
		</div>
		 <?php }}
else
{
?>	
	<div class="subdiv" align="center" style="width:800px;" >No Matches Found!</div>
	<?php }?>	
</div>	
<?php include 'footer.php' ;?>
