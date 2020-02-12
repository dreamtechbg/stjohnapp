<?php
$catId = $_REQUEST['catId'];
include_once("common.php");
include_once("class/Categories.Class.php");
$objCat = new Categories($objConnection);
$fetch = $objCat->getSubCategory($catId);
$return_arr = array();
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	    $row_array['id'] = $row['id'];
	   // $row_array['name'] = $row['name'];
	    $row_array['parent '] = $row['parent'];
            if($row_array['parent ']==0)
	    $row_array['name'] = "Other";
	    else
	    $row_array['name'] = $row['name'];
	    array_push($return_arr,$row_array);
	}
	echo json_encode($return_arr);
