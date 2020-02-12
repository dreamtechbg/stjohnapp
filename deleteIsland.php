<?php
	$id = $_REQUEST['rowId'];
	include_once("common.php");
	include_once("class/AboutIsland.Class.php");
	$objIsland = new AboutIsland($objConnection);
	$objIsland->moverestIsland($id);
	$result = $objIsland->deleteIsland($id);
	if($result){
		header("location:./islandList.php");
	}
