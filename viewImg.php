<?php
	$itemId = $_REQUEST['itemId'];
	$catId = $_REQUEST['catId'];
	$type = $_REQUEST['type'];
	include_once("common.php");
	include_once("class/ItemImage.Class.php");
	include 'header.php';
	?>
<div class="contentRight">
	<div align="center" style="font-weight:bold;"><?php echo $_REQUEST['name']; ?></div>	
	<div style="float:right;margin-right:20px;margin-top:20px;margin-bottom:10px;"><a href="./addImg.php?rowId=<?php echo $itemId;?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>&name=<?php echo htmlspecialchars($_REQUEST['name'], ENT_QUOTES, 'UTF-8');?>">Add New Image</a><br/>
	<a href="./editItem.php?rowId=<?php echo $itemId;?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>">BACK</a></div>
		<div class="topdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:50px;">ID</div>
			<div class="subdiv" align="left" style="width:200px;">Images</div>
			<div class="subdiv" align="left" style="width:200px;" >captions</div>
			<div class="subdiv subdiv_2" align="left">Actions</div>
		</div>
		<?php $objImg = new ItemImage($objConnection);
        		$result1 = $objImg->getImg($itemId);
        		$no_rows = mysql_num_rows($result1);
        		$i = 1;
        		if($no_rows > 0) { ?>
        		<?php while($row = mysql_fetch_array($result1)){
	        					$imgId = $row['id'];	
	        					$img = $row['image'];
	        					?>
        <div  class="listtopdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:50px;display:block;" ><?php echo $i ?></div>
			<div class="subdiv" align="left" style="width:200px;display:block;" ><img src="upload/<?php echo $img;?>"  height="50" width="50"></div>
			<div class="subdiv" align="left" style="width:200px;display:block;" ><?php echo $row['caption']; ?></div>
			<!--<div class="subdiv" align="left" style="width:200px;display:block;" ><?php echo htmlspecialchars($row['caption'], ENT_QUOTES, 'UTF-8'); ?></div>-->
			<div class="subdiv subdiv_2" align="left" style="display:block;">
			 	<a href="./editImg.php?imageId=<?php echo $row['id'];?>&rowId=<?php echo $itemId;?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>&name=<?php echo htmlspecialchars($_REQUEST['name'], ENT_QUOTES, 'UTF-8');?>">Edit</a> 
				<a href="./deleteImg.php?imageId=<?php echo $row['id'];?>&rowId=<?php echo $itemId;?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>" onclick="return confirm('Are you sure?')">Delete</a>
		    </div>
		</div>
		<?php $i++;} ?>
		<?php }
			else{ ?>
				<div align="center" style="padding-top:150px"> No images </div>

			<?php }


?>
			
</div>
<?php include 'footer.php' ;?>
