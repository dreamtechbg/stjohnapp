<?php
	$itemId = $_REQUEST['itemId'];
	include_once("common.php");
	include_once("class/ItemImage.Class.php");
	$objImg = new ItemImage($objConnection);
	$fetch = $objImg->getImg($itemId);
	$return_arr = array();
	$base_url = $_SERVER['SERVER_NAME'];
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
		$image = $row['image'];
		$img = rawurlencode ($image);
		$imgUrl = "http://".$base_url."/trailscms/compress/".$img;
	    $row_array['id'] = $row['id'];
	    $row_array['imageUrl'] = $imgUrl;
	    $row_array['caption'] = $row['caption'];
	    array_push($return_arr,$row_array);
	}
	echo json_encode($return_arr);
?>
