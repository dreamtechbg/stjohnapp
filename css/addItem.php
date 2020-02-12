<?php
include_once("common.php");
include_once("class/Categories.Class.php");
include_once("class/Items.Class.php");
include_once("class/ItemImage.Class.php");
include_once("class/Location.Class.php");
include("resize-class.php");
$catId = $_REQUEST['catId'];
$type = $_REQUEST['type'];
$objCat = new Categories($objConnection);
$objItems = new Items($objConnection);
$subResult = $objCat->getSubCategory($catId);
$countCat =  mysql_num_rows($subResult);
$date = date('Y-m-d H:i:s');
$objLocation = new Location();


if(isset($_POST['submit1'])){
	$error = 0;
	$itemname = $_POST['itemName'];
	$itemDesc = $_POST['itemDesc'];
	$itemPhone = $_POST['itemPhone'];
	$itemEmail = $_POST['itemEmail'];
	$itemWebsite = $_POST['itemWebsite'];
	$itemAddress1 = $_POST['itemAddress1'];
	$itemAddress2 = $_POST['itemAddress2'];
	
//	$itemLocation = $_POST['itemLocation'];
//	$itemlat = $_POST['itemLatitude'];
//	$itemlong = $_POST['itemLongitude'];
	$geoPoints = explode(',', $objLocation->getLocation($itemAddress1,$itemAddress2));
	$lat =  $geoPoints[0];
	$lon = $geoPoints[1];
	if($_POST['Latitude']!='')
	{
    $itemAddress1 = $_POST['Latitude'];
	$itemAddress2 = $_POST['Longnitude'];
	$lat =  $itemAddress1;
	$lon = $itemAddress2;
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
	
	} 
	if($itemAddress1 == ''){
		$errorAct = "Please enter a Value";
		$error = 1;
	}
	if($itemAddress2 == ''){
		$errorAct = "Please enter a Value";
		$error = 1;
	}
//	if($itemlat==''){
//		$errorLat = "Please enter latitude";
//		$error = 1;
//	}else if(!preg_match('/^[-]?[0-9]+[.]?[0-9]*[\s]?[EWSN]?$/',$itemlat)){
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
		$i=0;
		$flag_true = true;
		foreach($_FILES as $file){
			
			
			$filename= $file["name"];
			if ($filename != '') {
				$i++;
				$caption = $_POST['captionimage'.$i];
				$newFilename = date('mdYhis').''.$filename;
				$size = getimagesize($file["tmp_name"]);
				$width = $size[0];
				$height = $size[1];
				$arr_Image[] = array('tempName'=>$file["tmp_name"], 'caption'=>$caption,'newFilename'=>$newFilename,'size'=>$size);				 

			}

		}
		
		
		
		if($flag_true == true){
			$k = 0;
		foreach($arr_Image as $arr_images){
				$k++;
				
				if($k==1){
					$result = $objItems->insertItem($category, $itemname, $itemDesc, $itemPhone, $itemEmail, $itemWebsite, $itemAddress1, $itemAddress2,$lat, $lon, $date);
					$id = mysql_insert_id();
				}
					$getSize = $arr_images['size'];
					$width = $getSize[0];
					$height = $getSize[1];
					if($width>320 && $height>400){
						move_uploaded_file($arr_images['tempName'],"upload/".$arr_images['newFilename']);
						
						$resizeObj = new resize("upload/".$arr_images['newFilename']);
						
						$resizeObj -> resizeImage(320, 400, 'exact');
						$resizeObj -> saveImage("upload/".$arr_images['newFilename'], 100);
						$objImg = new ItemImage($objConnection);
						$result = $objImg->insertImagenew($id,$arr_images['newFilename'],$arr_images['caption']);
					}else{
						move_uploaded_file($arr_images['tempName'],"upload/".$arr_images['newFilename']);
						$objImg = new ItemImage($objConnection);
						$result = $objImg->insertImagenew($id,$arr_images['newFilename'],$arr_images['caption']);
					}
					
			}
		}
			
	
		if($i == 0 && $error == 0){
			$insertresult = $objItems->insertItem($category, $itemname, $itemDesc, $itemPhone, $itemEmail, $itemWebsite, $itemAddress1, $itemAddress2,$lat, $lon, $date);
		
			$id = mysql_insert_id();
		}
		if($error == 0){

			$message ="Successfull Entered";
			header("location:./catList.php?catId=".$_REQUEST['catId']."&type=".$_REQUEST['type']);
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
<div
	style="float: right; margin-right: 20px; margin-top: 20px; margin-bottom: 10px;"><a
	href="./catList.php?catId=<?php echo $catId;?>&type=<?php echo $type;?>">BACK</a></div>
<form action="" enctype="multipart/form-data" method="post">
<table style="float: left; margin-left: 167px; margin-top: 26px;">
	<tr>
		<td align="right" class="left"></td>
		<td class="right"><label class="err_msg">
		<h2><?php echo $message; ?></h2>
		</label></td>
	</tr>
	<?php if($countCat != 0){?>
	
	<tr>
		<td align="right" class="left">Category</td>
		<td class="right">		
								
		<select name="category" style="" class="select">
				
					<option value="">Select</option>
						<?php 	while($row = mysql_fetch_array($subResult)){ ?>
					<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
					<?php }?>
		</select> 
		
		<br />
		<label class="err_msg"><?php echo $errorCat;?></label></td>
	</tr>
	<?php }?>
	<tr>
		<td align="right" class="left"><label>Item Name</label></td>
		<td class="right"><input type="text" name="itemName"
			value="<?php echo $_POST['itemName'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorName;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Description</label></td>
		<td class="right"><textarea name="itemDesc" id="itemDesc" class="textarea_style"
			rows="4" cols="22"><?php  echo $_POST['itemDesc'];?></textarea> <br />
		<label class="err_msg"><?php echo $errorDesc;?></label></td>
	</tr>
	<?php 
		if($_REQUEST['type'] != 2) { ?>
			<tr>
		<td align="right" class="left"><label>Phone</label></td>
		<td class="right"><input type="text" name="itemPhone"
			value="<?php  echo $_POST['itemPhone'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorPhone;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Email</label></td>
		<td class="right"><input type="text" name="itemEmail"
			value="<?php  echo $_POST['itemEmail'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorEmail;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Website</label></td>
		<td class="right"><input type="text" name="itemWebsite"
			value="<?php  echo $_POST['itemWebsite'];?>"
			class="textbox_style" /> <br />
		<label class="err_msg"><?php echo $errorWeb;?></label></td>
	</tr>
		
		<?php }
	
	?>
	
	<!--<tr>
		<td align="right" class="left"><label>Latitude</label></td>
		<td class="right"><input type="text" id="Latitude"
			name="itemLatitude"
			value="<?php //echo $_POST['itemLatitude'];?>"
			class="textbox_style" /> <br />
		<label class="err_msg"><?php // echo $errorLat;?></label></td>
		<td><span class="tooltip" style="display: none;">
		<div>
		<div class="tooltipContent">( Example 18.335742)</div>
		</div>
		</span></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Longitude</label></td>
		<td class="right"><input type="text" id="Longitude"
			name="itemLongitude"
			value="<?php // echo $_POST['itemLongitude']; ?>"
			class="textbox_style" /> <br />
		<label class="err_msg"><?php //echo $errorLong;?></label></td>
		<td><span class="tooltip1" style="display: none;">
		<div>
		<div class="tooltipContent">(Example 64.798272)</div>
		</div>
		</span></td>
	</tr>
	-->
	
	<tr>
	
		<td align="right" class="left"><label>Select Address entering type</label></td>
		<td class="right">
			<select id="enterType">				
				<option value="1">Address</option>
				<option value="2">Value</option>
			</select> 
			<br />
		<label class="err_msg"><?php echo $errorAct;?></label>
		</td>
		
	</tr>
	
	<tr class="address">
	
		<td align="right" class="left"><label>Address1</label></td>
		<td class="right"><input type="text" name="itemAddress1"
			value="<?php  echo $_POST['itemAddress1'];?>"
			class="textbox_style" /> <br />
		<label class="err_msg"><?php echo $errorAct;?></label></td>
		
	</tr>
	<tr class="address">
		<td align="right" class="left"><label>Address2</label></td>
		<td class="right"><input type="text" name="itemAddress2"
			value="<?php  echo $_POST['itemAddress2'];?>"
			class="textbox_style" /> <br />
		<label class="err_msg"><?php echo $errorAct;?></label></td>
	</tr>
	
	<tr class="value">
		<td align="right" class="left"><label>Latitude</label></td>
		<td class="right"><input type="text" name="Latitude"
			value="<?php  echo $_POST['itemAddress1'];?>"
			class="textbox_style" /> <br />
		<label class="err_msg"><?php echo $errorAct;?></label></td>
	</tr>
	
	<tr class="value">
		<td align="right" class="left"><label>Longnitude</label></td>
		<td class="right"><input type="text" name="Longnitude"
			value="<?php  echo $_POST['itemAddress2'];?>"
			class="textbox_style" /> <br />
		<label class="err_msg"><?php echo $errorAct;?></label></td>
	</tr>
	
	<tr>
		<td align="right" class="left"><label for='Image1'>Image Name 1: *</label></td>
		<td class="right"><input type="file" id="image1" name="image1"
			value="" /></td>
	</tr>
	<tr>
		<td align="right" class="left"><label for='Image1'>Caption Image 1: </label>
		</td>
		<td class="right"><input type="text" id="captionimage1"
			name="captionimage1" class="textbox_style" value="" /></td>
	</tr>
	<input id="imgNumber" type="hidden" value="1" name="imgNumber">
	<tr>
		<td align="right" class="left"></td>
		<td class="addImg right"><a href="javascript:void(0)">add more Images
		[+]</a></td>
	</tr>
	<tr>
		<td colspan="2" align="center" class="left"><label class="err_msg"><?php echo $errorImg;?></label></td>
	</tr>
	<tr>
		<td></td>
		<?php if($countCat == 0){?>
				<?php $rowName = $objAdmin->getCatName($catId);
					  $rowResult = mysql_fetch_array($rowName);?>
					  <input type = "hidden" name = "category" value="<?php echo $rowResult['id'];?>"/>
		<?php }?>
		<td><input type="submit" name="submit1" value="Save and Continue"></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</form>
</div>
				<?php include 'footer.php' ;?>
