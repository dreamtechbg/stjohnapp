<?php
include_once("common.php");
include_once("class/Categories.Class.php");
include_once("class/Items.Class.php");
include_once("class/ItemImage.Class.php");
include_once("class/Location.Class.php");
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
$objLocation = new Location();
if(empty($message))
$message='';
 if(empty($errorCat))
$errorCat='';
 if(empty($errorName))
$errorName='';
 if(empty($errorDesc))
$errorDesc='';
 if(empty($errorPhone))
$errorPhone='';
 if(empty($errorEmail))
$errorEmail='';
 if(empty($errorWeb))
$errorWeb='';
 if(empty($errorAct))
$errorAct='';
 if(empty($errorImg))
$errorImg='';
 if(empty($trail_no))
$trail_no='';

if(isset($_POST['submit1'])){
	
	$itemname = $_POST['itemName'];
	$itemname = mysql_escape_string($itemname);
	$itemDesc = $_POST['itemDesc'];
	$itemDesc = mysql_escape_string($itemDesc);
	$itemPhone = $_POST['itemPhone'];
	$itemEmail = $_POST['itemEmail'];
	$subdesc=substr($_POST['itemWebsite'],0,4);
	if($subdesc=='http')
	$urlpre="";
	else
	$urlpre="https://";
	$itemWebsite = $urlpre.$_POST['itemWebsite'];
	$itemAddress1 = $_POST['itemAddress1'];
	//$itemAddress2 = $_POST['itemAddress2'];
	$latitude = $_POST['latitude'];
	$longnitude = $_POST['longnitude'];
	$trail_no = $_POST['trail_no'];
//	$itemlat = $_POST['itemLatitude'];
//	$itemlong = $_POST['itemLongitude'];
	$geoPoints = explode(',', $objLocation->getLocation($itemAddress1));
	$lat =  $geoPoints[0];
	$lon = $geoPoints[1];
if(!empty($itemAddress1))
	{
	if($lat==''||$lon=='')
	{
		$errorlocation="Invalid Location";
		$error = 1;
	}
	}
/*if($_POST['Latitude']!='')
	{
    $itemAddress1 = $_POST['Latitude'];
	$itemAddress2 = $_POST['Longnitude'];
	$lat =  $itemAddress1;
	$lon = $itemAddress2;
	}*/
if($latitude != '' && $longnitude != '')
	{
	$lat =  $latitude;
	$lon = $longnitude;
	}
	$category = $_POST['category'];
	if($itemname==''){
		$errorName = "Please Enter item Name";
		$error = 1;
	}
	if($itemDesc==''){
		$errorDesc = "Please Enter a description";
		$error = 1;
	}
	if($_REQUEST['type'] != 2) {
	if($itemPhone == ''){
		$errorPhone = "Please enter a number";
		$error = 1;
	}else if(!preg_match("/^[+]?[0-9-]{1,13}$/", $itemPhone)) {
		$errorPhone = "Please enter a valid number";
		$error = 1;
	}
	if($itemEmail == ''){
		$errorEmail = "Please enter a valid email address";
		$error = 1;
	}else if(!filter_var(trim($itemEmail),FILTER_VALIDATE_EMAIL)){
		$errorEmail = "Please enter a valid email address";
		$error = 1;
	}
	if($itemWebsite == ''){
		$errorWeb = "Please enter a website";
		$error = 1;
	}
	else if(!preg_match('/^(http[s]?:\/\/)(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/', trim($itemWebsite)))
		{
			$errorWeb = "Please enter a valid Web address";
			$error = 1;
		}
	} 
	/*if($itemAddress1 == ''){
		$errorAct = "Please enter the Address";
		$error = 1;
	}
	if($itemAddress2==''){
		$errorLat = "Please enter the Address";
		$error = 1;
	}*/
	
	
if($itemAddress1 == ''){
	//	$errorAct = "Please enter a Address";
		//$error = 1;
		if($latitude == '' || $longnitude == '')
		{
			$errorlat = "Please enter a Value";
			$errorlon = "Please enter a Value";
			$errorAct = "Please enter a Address or GPS Co-Ordinates";
		$error = 1;
		}
		
	}
	
	
//	else if(!preg_match('/^[-]?[0-9]+[.]?[0-9]*[\s]?[EWSN]?$/',$itemlat)){
//		$errorLat = "Please enter valid latitude";
//		$error = 1;
//	}
	if($category==''){
		$errorCat = "Please select a category";
		$error = 1;
	}
//	if($itemlong==''){
//		$errorLong = "Please enter longitude";
//		$error = 1;
//	}else if(!preg_match('/^[-]?[0-9]+[.]?[0-9]*[\s]?[EWSN]?$/',$itemlong)){
//		$errorLong = "Please enter valid latitude";
//		$error = 1;
//	}

	if($error == 0){
			$update = $objItems->updateItem($category, $itemname, $itemDesc, $itemPhone, $itemEmail, $itemWebsite, $itemAddress1, $itemAddress2,$lat, $lon, $rowId);
			$objItems->updatetrailno($trail_no,$rowId);
			if($update){
				header("location:./catList.php?catId=".$_REQUEST['catId']."&type=".$_REQUEST['type']);
			}else{
				die('Unable To Update');
			}
	}
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
<div
	style="float: right; margin-right: 20px; margin-top: 20px; margin-bottom: 10px;"><a
	href="./catList.php?catId=<?php echo $catId;?>&type=<?php echo $type;?>">BACK</a></div>
<form action="" enctype="multipart/form-data" method="post">
<table style="float: left; margin-left: 167px; margin-top: 26px;">
	<?php while($row = mysql_fetch_array($Itemresult)) {
	?>
	<tr>
		<td align="right" class="left"></td>
		<td class="right"><label class="err_msg">
		<h2> <?php echo $message; ?></h2>
		</label></td>
	</tr>
	<?php if($countCat != 0){?>
	<tr>
		<td align="right" class="left">Category</td>
		<td class="right"><select name="category" style="" class="select">
		<?php // $rowName = $objCat->getCatName($catId);
			  // $rowResult = mysql_fetch_array($rowName);
			?>
			<option value="">select</option>
	
				<?php 	while($row1 = mysql_fetch_array($subResult)){ ?>
			<option <?php if($row['category_id'] == $row1['id']) echo 'selected';?> value="<?php echo $row1['id'];?>"><?php echo $row1['name'];?></option>
			<?php }?>
		</select> <br />
				
		<label class="err_msg"><?php echo $errorCat;?></label></td>
	</tr>
	<?php }?>
	<tr>
		<td align="right" class="left"><label>Item Name<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemName"
			value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorName;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Description<font color="red">*</font></label></td>
		<td class="right"><textarea name="itemDesc" id="itemDesc" class="textarea_style"
			rows="4" cols="22"><?php echo $row['description'];?></textarea> <br />
		<label class="err_msg"><?php echo $errorDesc;?></label></td>
	</tr>
	<?php 
		if($_REQUEST['type'] != 2) { ?>
			<tr>
		<td align="right" class="left"><label>Phone<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemPhone"
			value="<?php echo $row['phone'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorPhone;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Email<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemEmail"
			value="<?php echo $row['email'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorEmail;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Website<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemWebsite"
			value="<?php echo $row['website'];?>"
			class="textbox_style" /> <br />
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
						class="textbox_style" /> <br />
						<label class="err_msg"><?php echo $errorlocation;?></label>
						</td></tr>	
				
				
			
			  	<tr><td align="right" class="left">
					<label>Latitude</label></td>
					<td><input type="text" name="latitude"
						value="<?php  echo $row['latitude'];?>"
						class="textbox_style" /> <br />
						</td></tr>
					
				<tr><td align="right" class="left">
					<label>Longnitude</label></td>
					<td><input type="text" name="longnitude"
						value="<?php  echo $row['lognitude'];?>"
						class="textbox_style" /> <br />
						<label class="err_msg"><?php echo $errorAct;?></label></td></tr>


				<tr><td align="right" class="left">
					<label>Trail Number</label></td>
					<td><input type="text" name="trail_no"
						value="<?php  echo $row['trail_no'];?>"
						class="textbox_style" /> <br />
						</td></tr>
	
	 <tr>
        	<td></td>
        	<td>
        		 <a href="./viewImg.php?itemId=<?php echo $row['id'];?>&catId=<?php echo $catId; ?>&type=<?php echo $type; ?>&name=<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');?>">View Images</a>
        	</td>
	</tr>
	<?php }?>
	<tr>
		<td></td>
		<?php if($countCat == 0){?>
				<?php $rowName = $objCat->getCatName($catId);
					  $rowResult = mysql_fetch_array($rowName);?>
					  <input type = "hidden" name = "category" value="<?php echo $rowResult['id'];?>"/>
		<?php }?>
		<td><input type="submit" name="submit1" value="Update"></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</form>
</div>
				<?php include 'footer.php' ;?>
