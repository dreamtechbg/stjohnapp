<?php
include_once("common.php");
include_once("class/Categories.Class.php");
include_once("class/Items.Class.php");
include_once("class/ItemImage.Class.php");
include("resize-class.php");
$catId = $_REQUEST['catId'];
$type = $_REQUEST['type'];
$rowId = $_REQUEST['rowId'];
$objCat = new Categories($objConnection);
$objItems = new Items($objConnection);
$subResult = $objCat->getSubCategory($catId);
$countCat =  mysql_num_rows($subResult);
$Itemresult = $objItems->getItemsByPk($rowId);
$date = date('Y-m-d H:i:s');

if(isset($_POST['submit1'])){
	header("location:./catList.php?catId=".$_REQUEST['catId']."&type=".$_REQUEST['type']);
}

?>
<?php include 'header.php';?>
<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
    nicEditors.editors.push(
        new nicEditor().panelInstance(
            document.getElementById('itemDesc')
        )
    );
});
//]]>
</script>
<div class="contentRight">
<div align="center" style="font-weight:bold;"><?php echo $_REQUEST['name']; ?></div>
<?php 
$message='';
$errorCat='';
$errorName='';
$errorDesc='';
$errorAct='';
?>
<form action="" enctype="multipart/form-data" method="post">
<table style="float: left; margin-left: 167px; margin-top: 26px;">
	<?php while($row = mysql_fetch_array($Itemresult)) {
	?>
	<tr>
		<td align="right" class="left"></td>
		<td class="right"><label class="err_msg">
		<h2><?php echo $message; ?></h2>
		</label></td>
	</tr>
	<?php if($countCat != 0) {?>
	<tr>
		<td align="right" class="left">Category</td>
		<td class="right"><select name="category" style="" class="select" disabled="disabled">
		<?php $rowName = $objCat->getCatName($catId);
			$rowResult = mysql_fetch_array($rowName);
			?>
			<option value="<?php echo $rowResult['id'];?>"><?php echo $rowResult['name'];?></option>
	
				<?php 	while($row1 = mysql_fetch_array($subResult)){ ?>
			<option <?php if($row['category_id'] == $row1['id']) echo 'selected';?> value="<?php echo $row1['id'];?>"><?php echo $row1['name'];?></option>
			<?php }?>
		</select> <br />
				
		<label class="err_msg"><?php echo $errorCat;?></label></td>
	</tr>
	<?php }?>
	<tr>
		<td align="right" class="left"><label>Item Name</label></td>
		<td class="right"><input type="text" name="itemName"
			value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');?>" class="textbox_style" readonly/>
		<br />
		<label class="err_msg"><?php echo $errorName;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Description</label></td>
		<td class="right"><textarea name="itemDesc" id="itemDesc" class="textarea_style"
			rows="4" cols="22" readonly><?php echo $row['description'];?></textarea> <br />
		<label class="err_msg"><?php echo $errorDesc;?></label></td>
	</tr>
	<?php 
		if($_REQUEST['type'] != 2) { ?>
			<tr>
		<td align="right" class="left"><label>Phone</label></td>
		<td class="right"><input type="text" name="itemPhone"
			value="<?php echo $row['phone'];?>" class="textbox_style" readonly/>
		<br />
		<label class="err_msg"><?php echo $errorPhone;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Email</label></td>
		<td class="right"><input type="text" name="itemEmail"
			value="<?php echo $row['email'];?>" class="textbox_style" readonly />
		<br />
		<label class="err_msg"><?php echo $errorEmail;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Website</label></td>
		<td class="right"><input type="text" name="itemWebsite"
			value="<?php echo $row['website'];?>"
			class="textbox_style" readonly/> <br />
		<label class="err_msg"><?php echo $errorWeb;?></label></td>
	</tr>
						
		<?php }
	
	?>

	 
	<tr>
	
		<td></td><td>	
			<p>Enter either Location or GPS Co-Ordinates</p>	</td></tr>
			
							
				<tr><td align="right" class="left">
					<label>Location</label></td>
					<td><input type="text" name="itemAddress1"
						value="<?php  echo $row['location'];?>"
						class="textbox_style" readonly /> <br />
						</td></tr>	
				
				
			
			  	<tr><td align="right" class="left">
					<label>Latitude</label></td>
					<td><input type="text" name="latitude"
						value="<?php  echo $row['latitude'];?>"
						class="textbox_style" readonly /> <br />
						</td></tr>
					
				<tr><td align="right" class="left">
					<label>Longnitude</label></td>
					<td><input type="text" name="longnitude"
						value="<?php  echo $row['lognitude'];?>"
						class="textbox_style" readonly /> <br />
						<label class="err_msg"><?php echo $errorAct;?></label></td></tr>

				<tr><td align="right" class="left">
					<label>Trail Number</label></td>
					<td><input type="text" name="trail_no"
						value="<?php  echo $row['trail_no'];?>"
						class="textbox_style" readonly /> <br />
						</td></tr>
	<?php }?>
	<tr>
		<td></td>
		<td><input type="submit" name="submit1" value="Back"></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>

<?php 
	        			$objItems = new ItemImage($objConnection);
	        			$result1 = $objItems->getImg($rowId);
	        			$no_rows = mysql_num_rows($result1);
						if($no_rows > 0) {
	        			?>
	         <table style ="float: left;margin-bottom:20px;margin-left: 67px;margin-top: 26px;width:70%;border: 1px solid #DDDDDD;" border ="1" cellpadding="0" cellspacing="0">
	        		
	        		<tr>
	        			<td>slNo</td>	
	        			<td>Image</td>
	        			<td>Caption</td>
	        		</tr>
	        			<?php
							$i = 1;
	        				while($row = mysql_fetch_array($result1)){
	        				
	        					$img = $row['image']; ?>
	        					<tr>
	        						<td>
	        							<?php echo $i;?>
	        						</td>
	        						<td>
	        							<img src="upload/<?php echo $img;?>" alt="Smiley face" height="100" width="100">
	        						</td>
	        						<td>
	        							<?php echo $row['caption'];?>
	        						</td>
	        					</tr>
	        			<?php $i++; }?>
	        			
			</table>
	        	  <?php } ?>

</form>
</div>
				<?php include 'footer.php' ;?>
