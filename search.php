<?php
$name = $_REQUEST['name'];
include_once("common.php");
include_once("class/Items.Class.php");
include_once("class/Categories.Class.php");
$return_arr = array();
$objCat = new Categories($objConnection);
$objItems = new Items($objConnection);
$fetch = $objItems->searchItems($name);
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
		$result = $objCat->getCatName($row['category_id']);
		$resultCat = mysql_fetch_row($result);
	    $row_array['id'] = $row['id'];
	   	$row_array['category_id'] = $row['category_id'];
	   	$row_array['type'] = $resultCat[2];
	   	$row_array['parent'] = $resultCat[3];
	    $row_array['name'] = $row['name'];
	    $row_array['description'] = $row['description'];
	    $row_array['phone'] = $row['phone'];
	    $row_array['email'] = $row['email'];
	    $row_array['website'] = $row['website'];
	    $row_array['location'] = $row['location'];
	    $row_array['latitude'] = $row['latitude'];
	    $row_array['longitude'] = $row['lognitude'];
	    array_push($return_arr,$row_array);
	}
	echo json_encode($return_arr);