<?php
	include_once("common.php");
	include_once("class/ItemImage.Class.php");
	include("resize-class.php");
	$imgId = $_REQUEST['imageId'];
	$itemId = $_REQUEST['rowId'];
	$catId = $_REQUEST['catId'];
	$type = $_REQUEST['type'];
	$objImg = new ItemImage($objConnection);
	$result = $objImg->deleteImg($imgId);
	if($result){
		header("location:./viewImg.php?itemId=$itemId&catId=$catId&type=$type");
	}