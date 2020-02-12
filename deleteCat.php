<?php
include_once("common.php");
include_once("class/Categories.Class.php");
$objCat = new Categories($objConnection);
$catId = $_REQUEST['catId'];
$type = $_REQUEST['type'];
$id = $_REQUEST['rowId'];
if($type == 2)
{
$type="Informational";	
}
if($type == 3)
{
$type="Commercial";	
}

$objCat->moverestSub($type,$catId,$id);
$catDelete = $objCat->deleteSubCat($id);
if($catDelete){
	header("location:./ViewCat.php?catId=".$_REQUEST['catId']."&type=".$_REQUEST['type']);
}else{
	die('Unable to delete');
}
