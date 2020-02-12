<?php session_start();
	include_once("common.php");
	include_once("class/About_app.Class.php");
	$objApp = new About_app($objConnection);
	$return_arr = array();
	$fetch = $objApp->getAllApps(); 
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	    $row_array['id'] = $row['id'];
	    $row_array['name'] = $row['name'];
	    $row_array['description'] = $row['discription'];
	    array_push($return_arr,$row_array);
	}
	echo json_encode($return_arr);