<?php
include_once("common.php");
include_once("class/Items.Class.php");

$objItems = new Items($objConnection);
$return_arr = array();
$fetchItems = $objItems->fetchAllItems();

while ($row = mysql_fetch_array($fetchItems, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr['id'] = $row['id'];
	$fetch_arr['category_id'] = $row['category_id'];
	$fetch_arr['name'] = $row['name'];
	$fetch_arr['description'] = $row['description'];
	$fetch_arr['phone'] = $row['phone'];
	$fetch_arr['email'] = $row['email'];
	$fetch_arr['website'] = $row['website'];
	$fetch_arr['location'] = $row['location'];
	$fetch_arr['latitude'] = $row['latitude'];
	$fetch_arr['longitude'] = $row['lognitude'];
	$fetch_arr['created_at'] = $row['created_at'];
	$fetch_arr['order_no'] = $row['order_no'];
	$fetch_arr['sort_no'] = $row['sort_no'];
	array_push($return_arr, $fetch_arr);
}
echo json_encode($return_arr);
