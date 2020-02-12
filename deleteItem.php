<?php
include_once("common.php");
include_once("class/Items.Class.php");
$id = $_REQUEST['rowId'];
$cat_id = $_REQUEST['catId'];
$objItem= new Items($objConnection);
$objItem->moverestItems($cat_id,$id);
$itemDelete = $objItem->deleteItem($id);
if($itemDelete){
	header("location:./catList.php?catId=".$_REQUEST['catId']."&type=".$_REQUEST['type']);
}else{
	die('Unable to delete');
}
