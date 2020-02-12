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

$objCat->moverestMain($type,$catId,$id);
$resultCat = $objCat->deleteSubCat($id);
header("location:./Cat.php?type=".$_REQUEST['type']);



//###==###

//###==###
?>