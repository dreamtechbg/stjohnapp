<?php
	$id = $_REQUEST['rowId'];
	include_once("common.php");
	include_once("class/About_app.Class.php");
	$objApp = new About_app($objConnection);
	$objApp->moverestApp($id);
	$result = $objApp->deleteApp($id);
	if($result){
		header("location:./appList.php");
	}
