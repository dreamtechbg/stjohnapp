<?php
include_once("common.php");
include_once("class/Items.Class.php");

$obj_item = new Items($objConnection);
$pass_arr = array();
$fetchItems = $obj_item->fetchCompleteCategories();
while ($row = mysql_fetch_array($fetchItems, MYSQL_ASSOC)) { 	 	 	 	 	 	 	 	 	
	$fetch_arr['id'] = $row['id'];
	$fetch_arr['name'] = $row['name'];
	$fetch_arr['type'] = $row['type'];
	$fetch_arr['parent'] = $row['parent'];
	$fetch_arr['created_at'] = $row['created_at'];
	$fetch_arr['sort_no'] = $row['sort_no'];
	array_push($pass_arr, $fetch_arr);
}
echo json_encode($pass_arr);
