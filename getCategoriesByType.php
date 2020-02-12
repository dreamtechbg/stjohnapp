<?php
//$type = $_REQUEST['typeId'];
include_once("common.php");
include_once("class/Categories.Class.php");
$objCat = new Categories($objConnection);
$fetch = $objCat->getCatByallType();
	$return_arr = array();
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
		$countFetch = mysql_fetch_array($objCat->getSubCount($row['id']));
		$count = $countFetch[0];
	    $row_array['id'] = $row['id'];
	    $row_array['name'] = $row['name'];
	    $row_array['parent'] = $row['parent'];
            $row_array['type'] = $row['type'];
	    $row_array['childCount'] = $count;
	    array_push($return_arr,$row_array);
	}
	echo json_encode($return_arr);
