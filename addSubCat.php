<?php
include_once("common.php");
include_once("class/Categories.Class.php");
if(empty($message))
$message='';
if(empty($_POST['catName']))
$_POST['catName']='';
if(empty($errorName))
$errorName='';
$catId = $_REQUEST['catId'];
$type = $_REQUEST['type'];
$objCat = new Categories($objConnection);
$date = date('Y-m-d H:i:s');
if(isset($_POST['submit'])){
	$error = 0;
	$catName = $_POST['catName'];
	if($catName==''){
		$errorName = "Please Enter Category Name";
		$error = 1;
	}
	if($error == 0){
		
		if($type == 2){
			
			$insertSubCat = $objCat->insertSubCat($catName,'Informational',$catId,$date);
		}else if($type == 3){
			$insertSubCat = $objCat->insertSubCat($catName,'Commercial',$catId,$date);
		}
		
		if($insertSubCat){
			header("location:./ViewCat.php?catId=".$_REQUEST['catId']."&type=".$_REQUEST['type']);
		}
	}
}


?>
<?php include 'header.php';?>
<div class="contentRight">
<div
	style="float: right; margin-right: 20px; margin-top: 20px; margin-bottom: 10px;"><a
	href="./ViewCat.php?type=<?php echo $type;?>&catId=<?php echo $catId;?>">BACK</a></div>
<form action="" enctype="multipart/form-data" method="post">
<table style="float: left; margin-left: 167px; margin-top: 26px;">
	<tr>
		<td align="right" class="left"></td>
		<td class="right"><label class="err_msg">
		<h2><?php echo $message; ?></h2>
		</label></td>
	</tr>
	<tr>
		<td align="right" class="left"><label>Category Name</label></td>
		<td class="right"><input type="text" name="catName"
			value="<?php echo $_POST['catName'];?>" class="textbox_style" />
		<br />
		<label class="err_msg"><?php echo $errorName;?></label></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Save and Continue"></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</form>
</div>
				<?php include 'footer.php' ;?>
