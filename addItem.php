<?php
//$error=0;
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
$subResult = $objCat->getSubCatByParent($catId);
$countCat =  mysql_num_rows($subResult);
$date = date('Y-m-d H:i:s');
$objLocation = new Location();
 
/*$message='';
$errorCat='';
$errorName='';
$errorDesc='';
$errorPhone='';
$errorEmail='';
$errorWeb='';
$_POST['latitude']='';
$_POST['itemDesc']='';
$_POST['itemName']='';
$_POST['longnitude']='';
$errorAct='';
$errorImg='';
*/
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
 if(empty($_POST['latitude']))
$_POST['latitude']='';
 if(empty($_POST['itemDesc']))
$_POST['itemDesc']='';
 if(empty($_POST['itemName']))
$_POST['itemName']='';
 if(empty($_POST['longnitude']))
$_POST['longnitude']='';
 if(empty($errorAct))
$errorAct='';
 if(empty($errorImg))
$errorImg='';
if(empty($_POST['itemPhone']))
$_POST['itemPhone']='';
if(empty($_POST['itemEmail']))
$_POST['itemEmail']='';
if(empty($_POST['itemWebsite']))
$_POST['itemWebsite']='';
if(empty($_POST['itemAddress1']))
$_POST['itemAddress1']='';

if(empty($_POST['trail_no']))
$_POST['trail_no']='';
if(isset($_POST['submit1'])){
	//$error = 0;
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
//	$itemLocation = $_POST['itemLocation'];
//	$itemlat = $_POST['itemLatitude'];
//	$itemlong = $_POST['itemLongitude'];
	//$geoPoints = explode(',', $objLocation->getLocation($itemAddress1,$itemAddress2));
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
	//if($lat==0)
/*	if($_POST['Latitude']!='')
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
if($category==0)
	{
		
		$categoryidpassed=$_POST['categoryidpassed'];
		$rowName = $objCat->getCatName($categoryidpassed);
					$rowResult = mysql_fetch_array($rowName);
					$category=$rowResult['id'];
	}
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
		/*else if(!filter_var($itemWebsite,FILTER_VALIDATE_URL)){
			$errorWeb = "Please enter a valid Web address";
			$error = 1;
		}*/
	
	//else if(!preg_match('/^(www.\.)([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i',$itemWebsite))
	else if(!preg_match('/^(http[s]?:\/\/)(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/', trim($itemWebsite)))
		{
			$errorWeb = "Please enter a valid Web address";
			$error = 1;
		}
/*	else if(!preg_match('|^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$', $itemWebsite))
		{
			$errorWeb = "Please enter a valid Web address";
			$error = 1;
		}*/
	} 
/*	if($itemAddress1 == ''){
		$errorAct = "Please enter a Value";
		$error = 1;
	}
	if($itemAddress2 == ''){
		$errorAct = "Please enter a Value";
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
	
	
//	if($itemlat==''){
//		$errorLat = "Please enter latitude";
//		$error = 1;
//	}else if(!preg_match('/^[-]?[0-9]+[.]?[0-9]*[\s]?[EWSN]?$/',$itemlat)){
//		$errorLat = "Please enter valiEmaild latitude";
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
					$objItems->updatetrailno($trail_no,$id);
				}
					$getSize = $arr_images['size'];
					$width = $getSize[0];
					$height = $getSize[1];
					/*if($width>320 && $height>400){
						move_uploaded_file($arr_images['tempName'],"upload/".$arr_images['newFilename']);
						
						$resizeObj = new resize("upload/".$arr_images['newFilename']);
						
						$resizeObj -> resizeImage(320, 400, 'exact');
						$resizeObj -> saveImage("upload/".$arr_images['newFilename'], 100);
						$objImg = new ItemImage($objConnection);
						$result = $objImg->insertImagenew($id,$arr_images['newFilename'],$arr_images['caption']);
					}else{*/
					/*	function compress_image($source_url, $destination_url, $quality) 
						{ $info = getimagesize($source_url); 
						if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url); 
						elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url); 
						elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url); 
						imagejpeg($image, $destination_url, $quality);
						return $destination_url;
						} 
						$newurl = "compress/".$arr_images['newFilename']; 
						$compressfilename = compress_image($arr_images['tempName'], $newurl, 50); */
												

						move_uploaded_file($arr_images['tempName'],"upload/".$arr_images['newFilename']);
						$objImg = new ItemImage($objConnection);
						$result = $objImg->insertImagenew($id,$arr_images['newFilename'],$arr_images['caption']);
					/*}*/
					
			}
		}
			
	
		if($i == 0 && $error == 0){
			
			
			$insertresult = $objItems->insertItem($category, $itemname, $itemDesc, $itemPhone, $itemEmail, $itemWebsite, $itemAddress1, $itemAddress2,$lat, $lon, $date);
		
			$id = mysql_insert_id();
			$objItems->updatetrailno($trail_no,$id);
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
					<option value="0">None</option>
						<?php 	while($row = mysql_fetch_array($subResult)){ ?>
						<?php if($_POST['category']==$row['id']) {?>
					<option selected value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
						<?php } else {?>
					<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
					<?php } }?>
		</select> 
		
		<br />
		<label class="err_msg"><?php echo $errorCat;?></label></td>
	</tr>
	<?php }?>
	<tr>
		<td align="right" class="left"><label>Item Name<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemName"
			value="<?php echo $_POST['itemName'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorName;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Description<font color="red">*</font></label></td>
		<td class="right"><textarea name="itemDesc" id="itemDesc" class="textarea_style"
			rows="4" cols="22"><?php  echo $_POST['itemDesc'];?></textarea> <br />
		<label class="err_msg"><?php echo $errorDesc;?></label></td>
	</tr>
	<?php 
		if($_REQUEST['type'] != 2) { ?>
			<tr>
		<td align="right" class="left"><label>Phone<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemPhone"
			value="<?php  echo $_POST['itemPhone'];?>" class="textbox_style" maxlength="12"/>
		<br />
		<label class="err_msg"><?php echo $errorPhone;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Email<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemEmail"
			value="<?php  echo $_POST['itemEmail'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorEmail;?></label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Website<font color="red">*</font></label></td>
		<td class="right"><input type="text" name="itemWebsite"
			value="<?php  echo $_POST['itemWebsite'];?>"
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
						value="<?php  echo $_POST['itemAddress1'];?>"
						class="textbox_style" /> <br />
						<label class="err_msg"><?php echo $errorlocation;?></label>
						</td></tr>	
				
				
			
			  	<tr><td align="right" class="left">
					<label>Latitude</label></td>
					<td><input type="text" name="latitude"
						value="<?php  echo $_POST['latitude'];?>"
						class="textbox_style" /> <br />
						</td></tr>
					
				<tr><td align="right" class="left">
					<label>Longnitude</label></td>
					<td><input type="text" name="longnitude"
						value="<?php  echo $_POST['longnitude'];?>"
						class="textbox_style" /> <br />
						<label class="err_msg"><?php echo $errorAct;?></label></td></tr>
					<input type = "hidden" name = "categoryidpassed" value="<?php echo $catId;?>"/>


	<tr>
		
	
	</tr>
		<td align="right" class="left"><label>Trail Number</label></td>
		<td><input type="text" name="trail_no" value="<?php  echo $_POST['trail_no'];?>" class="textbox_style" /></td></tr>

	<tr>
		<td align="right" class="left"><label for='Image1'>Image Name 1: </label></td>
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
