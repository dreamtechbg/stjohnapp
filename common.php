<?php
	error_reporting(0);
	include_once("class/Connection.Class.php");
//	$userName =  "root";
//	$password = "root";
//	$hostName = "192.168.1.3";
//	$dbname = "trailmaster";
	
	
	$userName =  "trailscms";
	$password = "Trails2013#";
	$hostName = "localhost";
        $dbname = "trailscms1";

        	
	$objConnection = new Connection();
	$objConnection->configure($userName, $password, $hostName, $dbname);
