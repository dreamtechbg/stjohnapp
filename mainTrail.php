<?php
//###==###

//###==###



include_once("common.php");
include_once("class/Items.Class.php");
include_once("class/ItemImage.Class.php");
$return_arr = array();
$objItems = new Items($objConnection);
$objItemImg = new ItemImage($objConnection);
$fetch = $objItems->getMainTrail();
$base_url = $_SERVER['SERVER_NAME'];
while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
		$return_arr2 = array();
	    $row_array['id'] = $row['id'];
	    $row_array['category_id'] = $row['category_id'];
	    $row_array['name'] = $row['name'];
	    $row_array['description'] = $row['description'];
	    $row_array['latitude'] = $row['latitude'];
	    $row_array['longitude'] = $row['lognitude'];
	    $fetchImg = $objItemImg->getImg($row['id']);
		while ($row1 = mysql_fetch_array($fetchImg, MYSQL_ASSOC)){
	    	$img = $row1['image'];
			$imgId = $row1['id'];
			$image = rawurlencode ($img);
			$imgUrl = "http://".$base_url."/trailscms/upload/".$image;
	    	$row_array2['imageId'] = $row1['id'];
	    	$row_array2['imageUrl'] = $imgUrl;
	    	$row_array2['caption'] = $row1['caption'];
	    	array_push($return_arr2,$row_array2);
	    }
	    $row_array['images'] = $return_arr2;
	    array_push($return_arr,$row_array);
	}
	
	echo json_encode($return_arr);