<?php
include_once("common.php");
include_once("class/Items.Class.php");
include_once("class/ItemImage.Class.php");
$return_arr = array();
$objItems = new Items($objConnection);
$objItemImg = new ItemImage($objConnection);
	    $fetchImg = $objItemImg->getOfflineImages();
		while ($row1 = mysql_fetch_array($fetchImg, MYSQL_ASSOC)){
	    	$img = $row1['image'];
			$imgId = $row1['id'];
			$itemId = $row1['item_id'];
			$image = rawurlencode ($img);
			$imgUrl = "seestjohnapp.com/trailscms/upload/".$image;
	    	$row_array1['imageId'] = $row1['id'];
	    	$row_array1['imageUrl'] = $imgUrl;
	    	$row_array1['caption'] = $row1['caption'];
	    	$fetchItem = $objItems->getItemsByPk($itemId);
	    	while ($row2 = mysql_fetch_row($fetchItem, MYSQL_ASSOC)){
	    		
	    		$row_array1['category_id'] = $row2['category_id'];
	    		
	    	}
	    	array_push($return_arr,$row_array1);
	    }
	    
	
	
	echo json_encode($return_arr);
	?>
