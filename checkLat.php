<?php
include_once("class/Location.Class.php");
$addres1 = "silverhills";
$address2 = "kozhikode";
$objLocation = new Location();
$objLocation->getLocation($addres1,$address2);
