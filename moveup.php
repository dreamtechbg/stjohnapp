<?php
$cid=$_REQUEST['cid'];
$subtype=$_REQUEST['subtype'];
$item_id=$_REQUEST['id'];
include_once("common.php");
include_once("class/Items.Class.php");
$objItems = new Items($objConnection);
$results=$objItems->moveupItems($cid,$subtype,$item_id);
if ($results)
header('location:catList.php?catId='.$cid.'&type='.$subtype);
?>
