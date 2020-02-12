<?php
include_once("common.php");
include_once("class/Categories.Class.php");
include_once("class/ItemImage.Class.php");
include_once("class/Items.Class.php");
$objCat = new Categories($objConnection);
$objItem = new Items($objConnection);
$maintrail=$objCat->fetchTrailSub();
$row = mysql_fetch_row($maintrail, MYSQL_ASSOC);
$cat_id=$row['id'];

$subcat=$objCat->getSubCategory($cat_id);

if(isset($_POST['submit'])){
	$subcat_id = $_REQUEST['subcatid'];
$imginfo=$objItem->fetchItemsnimages($subcat_id);

}


?>
<?php include 'header.php';?>

<div class="contentRight">
<form action="" enctype="multipart/form-data" method="post">
<table style="float: left; margin-left: 167px; margin-top: 26px;">
	<tr>
		<td align="right" class="left"></td>
		<td class="right"><label class="err_msg">
	
		</label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Select Trail</label></td>
		<td class="right"><select name="subcatid"><option value="">select</option>
									<?php 	while($row1 = mysql_fetch_array($subcat))
									{	
										 ?>
									<option  value="<?php echo $row1['id'];?>"><?php echo $row1['name'];?></option>
							   <?php }?></select>
		<br />
		</td>
		
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>
	<tr>
		<td></td>
	</tr>

</table>

</form>


<div class="topdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:80px;">SlNo</div>
			<div class="subdiv" align="left" style="width:300px;">Images</div>
			<div class="subdiv" align="left" style="width:80px;">Select</div>
			</div>
			<?php 	
			$sl_no=1;
			while($row2 = mysql_fetch_array($imginfo))
									{	
										$imgurl="upload/".$row2['image'];
										$row_id=$row2['id'];
										?>
			<div  class="listtopdiv" id="searchheader">
			
							<div class="subdiv" align="left" style="width:80px;"><?php echo $sl_no;?></div>
							<div class="subdiv" align="left" style="width:300px;" ><img src="<?php echo $imgurl;?>" width="70" height="50"></img></div>
							<div class="subdiv" align="left" style="width:80px;"><a href="updateofflineimages.php?selectedid=<?php echo $row_id;?>&sub_id=<?php echo $subcat_id;?>">select</a></div>
							
							</div>
							
							<?php 
									$sl_no++;
									}?>
				<?php include 'footer.php' ;?>
