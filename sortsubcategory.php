<?php 
 $subparent=$_REQUEST['subparent'];
 $id=$_REQUEST['id'];
 $sortid=$_REQUEST['sortid'];
 $subtype=$_REQUEST['subtype'];
include_once("common.php");
include_once("class/Categories.Class.php");
$objCategory = new Categories($objConnection);
if($sortid==1)
{
	
$resultRow = $objCategory->movesubcategoryup($id,$subparent);
if ($resultRow)
header('location:ViewCat.php?type='.$subtype.'&catId='.$subparent);
}

if($sortid==2)
{
	
$resultRow = $objCategory->movesubcategorydown($id,$subparent);
if ($resultRow)
{
//header('location:ViewCat.php?type='.$subtype.'&catId='.$subparent);
$url="ViewCat.php?type=$subtype&catId=$subparent";

echo"<script type=\"text/javascript\">window.location.href=\"  $url  \";</script>";
}
}
?>
