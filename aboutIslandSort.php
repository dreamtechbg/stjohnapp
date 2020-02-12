<?php 
$id=$_REQUEST['id'];
$sortid=$_REQUEST['sortid'];
include_once("common.php");
include_once("class/AboutIsland.Class.php");
$objIsland = new AboutIsland($objConnection);
if($sortid==1)
{
	
$resultRow = $objIsland->moveup($id);
if ($resultRow)
header('location:islandList.php');
}

if($sortid==2)
{
	
$resultRow = $objIsland->movedown($id);
if ($resultRow)
header('location:islandList.php');
}
?>
