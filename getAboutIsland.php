<?php session_start();
	include_once("common.php");
	include_once("class/AboutIsland.Class.php");
	$objIsland = new AboutIsland($objConnection);
	$return_arr = array();
	$fetch = $objIsland->getAboutIsland(); 
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	    $row_array['id'] = $row['id'];
	    $row_array['name'] = $row['name'];
	    $row_array['description'] = $row['description'];
	    array_push($return_arr,$row_array);
	}
	
	    echo json_encode($return_arr);
	
	