<?php
session_start();

if (!isset($_SESSION['views'])) {
  header("location:./index.php");
}?>            
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin Panel | Trail Master</title>
        <link rel="icon" href="favicon.png" type="image/png" />
        <script src="js/scripts.js" type="text/javascript"></script>
        <script src="js/nicEdit.js" type="text/javascript"></script>
        <script src="js/admin_dev_script.js" type="text/javascript"></script>
        <!--[if IE 6]><script src="js/ie6.js" type="text/javascript"></script><![endif]-->
        <style type="text/css">@import url("css/styles.css");</style>
        <link href="css/admin_dev.css" media="screen" type="text/css" rel="stylesheet">
    </head>

    <body>
    	<?php 
    	include_once("common.php");
		include_once("class/Categories.Class.php");
		$objAdmin = new Categories($objConnection);
		$result1 = $objAdmin->getInfoCat();
		$result2 = $objAdmin->getComCat();
    	?>
    	<section id="container">
    		
        	<header class="pageHeader">
        		<div class="headerWrap">
	        		<h2>Trail Master Admin Panel</h2>
	        		<a class="btnLogout" href="./logout.php" title="Logout">Logout</a>
	        		<div class="clear"></div>
        		</div>
        	</header>
        	<section class="pageContent">
        		<aside>
        			<nav class="pageNav">
        				<ul>
        				
        					<li><a href="./home.php">Home</a></li>
        					<li>
        						<a href="Cat.php?type=<?php echo 2;?>">Informational</a>
        						<ul>
        						<?php 	while($row = mysql_fetch_array($result1)) {	?>
        							<li><a href="./catList.php?catId=<?php echo $row['id']?>&type=<?php echo 2; ?>"><?php echo $row['name'];?></a></li>
        						<?php }?>
        						</ul>
        					</li>
        					<li>
        						<a href="Cat.php?type=<?php echo 3;?>">Commercial</a>
        						<ul>
        							<?php 	while($row = mysql_fetch_array($result2)) {	?>
        							<li><a href="./catList.php?catId=<?php echo $row['id']?>&type=<?php echo 3; ?>"><?php echo $row['name'];?></a></li>
        						<?php }?>
        						</ul>
        					</li>
        					
<!--        					<li><a href="./activityList.php">Activities</a></li>-->
<!--        					<li><a href="./lodgeList.php">Lodging</a></li>-->
<!--        					<li><a href="./businessList.php">Business</a></li>-->
        					<li><a href="./islandList.php">About the Island</a></li>
        					<li><a href="./appList.php">About the App</a></li>
        				<!--	<li><a href="./setofflineimages.php">Offline Images</a></li>-->

        				</ul>
        			</nav>
        		</aside>
