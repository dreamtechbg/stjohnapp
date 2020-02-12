<?php
include_once("common.php");
include_once("class/ItemImage.Class.php");

$updateid=$_REQUEST['selectedid'];
$cat_id=$_REQUEST['sub_id'];

$objItemimages = new ItemImage($objConnection);
$objItemimages->updateOfflineStatus($cat_id);
$objItemimages->setOfflineStatus($updateid);
header("location:./home.php");
?>
