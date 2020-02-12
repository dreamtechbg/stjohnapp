<?php
$con = mysql_connect("localhost","trailscms","Trails123#");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("trailscms1", $con);
// some code
?>
