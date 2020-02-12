<?php
include_once("common.php");
include_once("class/Items.Class.php");
include_once("class/About_app.Class.php");
include_once("class/AboutIsland.Class.php");
include_once("class/Categories.Class.php");
include_once("class/DeletedData.Class.php");
include_once("class/ItemImage.Class.php");
//$date=$_REQUEST['date'];
//$date='2013-07-23 16:47:11';
$current_date=$_REQUEST['date'];
$date = date('Y-m-d h:m:-S',strtotime($current_date)- (24*3600*1));
$objItems = new Items($objConnection);
$objDeleted = new DeletedData($objConnection);
$return_arr = array();
$fetchItemscreated = $objItems->fetchAllItemsCreated($date);

while ($row = mysql_fetch_array($fetchItemscreated, MYSQL_ASSOC)) {
		 	 	 	 	 	 	 	 	 	
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
	$fetch_arr['address2'] = $row['address2'];
	$fetch_arr['order_no'] = $row['order_no'];
	$fetch_arr['sort_no'] = $row['sort_no'];
	$fetch_arr['trail_no'] = $row['trail_no'];
	
	
	
	array_push($return_arr, $fetch_arr);
}
echo "{\"ItemsTable\":{\"Created\":",json_encode($return_arr);




$return_arr = array();
$fetch_arr = array();
$fetchItemsupdated = $objItems->fetchAllItemsUpdated($date);

while ($row = mysql_fetch_array($fetchItemsupdated, MYSQL_ASSOC)) {
		 	 	 	 	 	 	 	 	 	
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
	$fetch_arr['address2'] = $row['address2'];
	$fetch_arr['order_no'] = $row['order_no'];
	$fetch_arr['sort_no'] = $row['sort_no'];
	$fetch_arr['trail_no'] = $row['trail_no'];
	
	
	
	array_push($return_arr, $fetch_arr);
}
echo ",\"Updated\":",json_encode($return_arr);


$return_arr = array();
$fetch_arr = array();
$fetchitemsdel=$objDeleted->getDeletedItems();
while ($row = mysql_fetch_array($fetchitemsdel, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr['id'] = $row['data_id'];
	$fetch_arr['table_name'] = $row['table_name'];
	

	array_push($return_arr, $fetch_arr);
}
echo ",\"Deleted\":",json_encode($return_arr),"}";





$return_arr = array();
$objApp = new About_app($objConnection);
$fetchAppcreated = $objApp->getAllAppsCreated($date);

while ($row1 = mysql_fetch_array($fetchAppcreated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr1['id'] = $row1['id'];
	$fetch_arr1['name'] = $row1['name'];
	$fetch_arr1['description'] = $row1['discription'];
	$fetch_arr1['created_at'] = $row1['created_at'];
	$fetch_arr1['sort_no'] = $row1['sort_no'];
	array_push($return_arr, $fetch_arr1);
}
echo ",\"AboutIsland\":{\"Created\":",json_encode($return_arr);




$return_arr = array();
$fetch_arr1 = array();
$fetchAppupdated = $objApp->getAllAppsUpdated($date);

while ($row1 = mysql_fetch_array($fetchAppupdated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr1['id'] = $row1['id'];
	$fetch_arr1['name'] = $row1['name'];
	$fetch_arr1['description'] = $row1['discription'];
	$fetch_arr1['created_at'] = $row1['created_at'];
	$fetch_arr1['sort_no'] = $row1['sort_no'];
	array_push($return_arr, $fetch_arr1);
}
echo ",\"Updated\":",json_encode($return_arr);


$return_arr = array();
$fetch_arr = array();
$fetchappsdel=$objDeleted->getDeletedApps();
while ($row = mysql_fetch_array($fetchappsdel, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr['id'] = $row['data_id'];
	$fetch_arr['table_name'] = $row['table_name'];
	

	array_push($return_arr, $fetch_arr);
}
echo ",\"Deleted\":",json_encode($return_arr),"}";





$return_arr = array();
$objIsland = new AboutIsland($objConnection);
$fetchIslandcreated = $objIsland->getAboutIslandCreated($date);
while ($row2 = mysql_fetch_array($fetchIslandcreated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr2['id'] = $row2['id'];
	$fetch_arr2['name'] = $row2['name'];
	$fetch_arr2['description'] = $row2['description'];
	$fetch_arr2['created_at'] = $row2['created_at'];
	$fetch_arr2['sort_no'] = $row2['sort_no'];
	array_push($return_arr, $fetch_arr2);
}
echo ",\"AboutApp\":{\"Created\":",json_encode($return_arr);



$return_arr = array();
$fetch_arr2 = array();
$fetchIslandupdated = $objIsland->getAboutIslandUpdated($date);
while ($row2 = mysql_fetch_array($fetchIslandupdated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr2['id'] = $row2['id'];
	$fetch_arr2['name'] = $row2['name'];
	$fetch_arr2['description'] = $row2['description'];
	$fetch_arr2['created_at'] = $row2['created_at'];
	$fetch_arr2['sort_no'] = $row2['sort_no'];
	array_push($return_arr, $fetch_arr2);
}
echo ",\"Updated\":",json_encode($return_arr);
$return_arr = array();
$fetch_arr = array();
$fetchislanddel=$objDeleted->getDeletedIslands();
while ($row = mysql_fetch_array($fetchislanddel, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr['id'] = $row['data_id'];
	$fetch_arr['table_name'] = $row['table_name'];
	

	array_push($return_arr, $fetch_arr);
}
echo ",\"Deleted\":",json_encode($return_arr),"}";





$return_arr = array();
$objCat = new Categories($objConnection);
$fetchCatcreated = $objCat->fetchCatTabCreated($date);
while ($row3 = mysql_fetch_array($fetchCatcreated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr3['id'] = $row3['id'];
	$fetch_arr3['name'] = $row3['name'];
	$fetch_arr3['type'] = $row3['type'];
	$fetch_arr3['parent'] = $row3['parent'];
	$fetch_arr3['created_at'] = $row3['created_at'];
	$fetch_arr3['sort_no'] = $row3['sort_no'];
	$fetch_arr3['sub_sortno'] = $row3['sub_sortno'];
	array_push($return_arr, $fetch_arr3);
}
echo ",\"Categories\":{\"Created\":",json_encode($return_arr);



$return_arr = array();
$fetch_arr3 = array();
$fetchCatupdated = $objCat->fetchCatTabUpdated($date);
while ($row3 = mysql_fetch_array($fetchCatupdated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr3['id'] = $row3['id'];
	$fetch_arr3['name'] = $row3['name'];
	$fetch_arr3['type'] = $row3['type'];
	$fetch_arr3['parent'] = $row3['parent'];
	$fetch_arr3['created_at'] = $row3['created_at'];
	$fetch_arr3['sort_no'] = $row3['sort_no'];
	$fetch_arr3['sub_sortno'] = $row3['sub_sortno'];
	array_push($return_arr, $fetch_arr3);
}
echo ",\"Updated\":",json_encode($return_arr);

$return_arr = array();
$fetch_arr = array();
$fetchcatdel=$objDeleted->getDeletedCategories();
while ($row = mysql_fetch_array($fetchcatdel, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr['id'] = $row['data_id'];
	$fetch_arr['table_name'] = $row['table_name'];
	

	array_push($return_arr, $fetch_arr);
}
echo ",\"Deleted\":",json_encode($return_arr),"}";

$return_arr = array();
$fetch_arr3 = array();
$objImage = new ItemImage($objConnection);
$fetchimgcreated=$objImage->fetchAllImagesCreated($date);
while ($row33 = mysql_fetch_array($fetchimgcreated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr3['id'] = $row33['id'];
	$fetch_arr3['item_id'] = $row33['item_id'];
	$fetch_arr3['image'] = $row33['image'];
	$fetch_arr3['caption'] = $row33['caption'];
	$fetch_arr3['created_at'] = $row33['created_at'];
	$fetch_arr3['offline_status'] = $row33['offline_status'];
	array_push($return_arr, $fetch_arr3);
}
echo ",\"Images\":{\"Created\":",json_encode($return_arr);


$return_arr = array();
$fetch_arr3 = array();
$fetchimgupdated=$objImage->fetchAllImagesUpdated($date);
while ($row33 = mysql_fetch_array($fetchimgupdated, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr3['id'] = $row33['id'];
	$fetch_arr3['item_id'] = $row33['item_id'];
	$fetch_arr3['image'] = $row33['image'];
	$fetch_arr3['caption'] = $row33['caption'];
	$fetch_arr3['created_at'] = $row33['created_at'];
	$fetch_arr3['offline_status'] = $row33['offline_status'];
	array_push($return_arr, $fetch_arr3);
}
echo ",\"Updated\":",json_encode($return_arr);


$return_arr = array();
$fetch_arr = array();
$fetchimgdel=$objDeleted->getDeletedImages();
while ($row = mysql_fetch_array($fetchimgdel, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr['id'] = $row['data_id'];
	$fetch_arr['table_name'] = $row['table_name'];
	

	array_push($return_arr, $fetch_arr);
}
echo ",\"Deleted\":",json_encode($return_arr),"}}";


/*
$return_arr = array();
$objApp = new About_app($objConnection);
$fetchApp = $objApp->getAllAppsUpdated($date);

while ($row1 = mysql_fetch_array($fetchApp, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr1['id'] = $row1['id'];
	$fetch_arr1['name'] = $row1['name'];
	$fetch_arr1['description'] = $row1['discription'];
	$fetch_arr1['created_at'] = $row1['created_at'];
	$fetch_arr1['sort_no'] = $row1['sort_no'];
	array_push($return_arr, $fetch_arr1);
}
echo ",\"AboutIsland\":",json_encode($return_arr);

$return_arr = array();
$objIsland = new AboutIsland($objConnection);
$fetchIsland = $objIsland->getAboutIslandUpdated($date);
while ($row2 = mysql_fetch_array($fetchIsland, MYSQL_ASSOC)) {  	 	 	 	 	 	 	 	 	 	
	$fetch_arr2['id'] = $row2['id'];
	$fetch_arr2['name'] = $row2['name'];
	$fetch_arr2['description'] = $row2['description'];
	$fetch_arr2['created_at'] = $row2['created_at'];
	$fetch_arr2['sort_no'] = $row2['sort_no'];
	array_push($return_arr, $fetch_arr2);
}
echo ",\"AboutApp\":",json_encode($return_arr);
//echo "{\"AboutIsland\":",json_encode($return_arr);*/
/*$return_arr = array();
$objCat = new Categories($objConnection);
$fetchCat = $objCat->fetchCatTabUpdated($date);
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
echo ",\"Categories\":",json_encode($return_arr),"}}";

//echo json_encode($return_arr);
*/

?>
