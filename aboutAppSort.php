<?php 
$id=$_REQUEST['id'];
$sortid=$_REQUEST['sortid'];
include_once("common.php");
include_once("class/About_app.Class.php");
$objIsland = new About_app($objConnection);
if($sortid==1)
{
	
$resultRow = $objIsland->moveup($id);
if ($resultRow)
header('location:appList.php');
}

if($sortid==2)
{
	
$resultRow = $objIsland->movedown($id);
if ($resultRow)
header('location:appList.php');
}
?>