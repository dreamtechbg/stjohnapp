<?php
include_once("common.php");
include_once("class/ItemImage.Class.php");
$objItems = new ItemImage($objConnection);
$results=$objItems->uploadimages();
?>
