<?php
$catId = $_REQUEST['catId'];
include_once("common.php");
include_once("class/Items.Class.php");
$objItems = new Items($objConnection);
$fetch = $objItems->getItems($catId);
$return_arr = array();
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	    $row_array['id'] = $row['id'];
	    $row_array['name'] = $row['name'];
	    $row_array['phone'] = $row['phone'];
	    $row_array['email'] = $row['email'];
	    $row_array['description'] = $row['description'];
	    $row_array['website'] = $row['website'];
	    $row_array['location'] = $row['location'];
	    $row_array['latitude'] = $row['latitude'];
	    $row_array['lognitude'] = $row['lognitude'];
	    $row_array['trail_no'] = $row['trail_no'];
	    $row_array['category_id'] = $row['category_id'];		
	    array_push($return_arr,$row_array);
	}
	echo json_encode($return_arr);
