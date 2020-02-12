<?php
include_once("common.php");
include_once("class/Items.Class.php");
include_once("class/About_app.Class.php");
include_once("class/AboutIsland.Class.php");
include_once("class/Categories.Class.php");

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
echo "{\"ItemsTable\":",json_encode($return_arr);

$return_arr = array();
$objApp = new About_app($objConnection);
$fetchApp = $objApp->getAllApps();

while ($row1 = mysql_fetch_array($fetchApp, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr1['id'] = $row1['id'];
	$fetch_arr1['name'] = $row1['name'];
	$fetch_arr1['description'] = $row1['discription'];
	$fetch_arr1['created_at'] = $row1['created_at'];
	$fetch_arr1['sort_no'] = $row1['sort_no'];
	array_push($return_arr, $fetch_arr1);
}
echo ",\"AboutApp\":",json_encode($return_arr);

$return_arr = array();
$objIsland = new AboutIsland($objConnection);
$fetchIsland = $objIsland->getAboutIsland();
while ($row2 = mysql_fetch_array($fetchIsland, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr2['id'] = $row2['id'];
	$fetch_arr2['name'] = $row2['name'];
	$fetch_arr2['description'] = $row2['description'];
	$fetch_arr2['created_at'] = $row2['created_at'];
	$fetch_arr2['sort_no'] = $row2['sort_no'];
	array_push($return_arr, $fetch_arr2);
}
echo ",\"AboutIsland\":",json_encode($return_arr);

$return_arr = array();
$objCat = new Categories($objConnection);
$fetchCat = $objCat->fetchCatTab();
while ($row3 = mysql_fetch_array($fetchCat, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr3['id'] = $row3['id'];
	$fetch_arr3['name'] = $row3['name'];
	$fetch_arr3['type'] = $row3['type'];
	$fetch_arr3['parent'] = $row3['parent'];
	$fetch_arr3['created_at'] = $row3['created_at'];
	$fetch_arr3['status_no'] = $row3['status_no'];
	$fetch_arr3['sort_no'] = $row3['sort_no'];
	array_push($return_arr, $fetch_arr3);
}
echo ",\"Categories\":",json_encode($return_arr),"}";




?>
