<?php 
$subtype=$_REQUEST['subtype'];
$id=$_REQUEST['id'];
$sortid=$_REQUEST['sortid'];
include_once("common.php");
include_once("class/Categories.Class.php");
$objCategory = new Categories($objConnection);
if($subtype==2)
$type="Informational";
else
$type="Commercial";
if($sortid==1)
{
$resultRow = $objCategory->movecategoryup($id,$type);
if ($resultRow)
echo "<script>location.href='Cat.php?type=$subtype';</script>";
}

if($sortid==2)
{
	
$resultRow = $objCategory->movecategorydown($id,$type);
if ($resultRow)
echo "<script>location.href='Cat.php?type=$subtype';</script>";
}
?>
