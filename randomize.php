<?php
$cid=$_POST['cid'];
$subtype=$_POST['subtype'];
include_once("common.php");
include_once("class/Items.Class.php");
$objItems = new Items($objConnection);
$results=$objItems->selectItemsrandom($cid, $subtype);
if ($results)
header('location:catList.php?catId='.$cid.'&type='.$subtype);

?>
