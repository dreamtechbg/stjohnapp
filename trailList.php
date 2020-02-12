
<?php
include_once("common.php");
include_once("class/Categories.Class.php");
$objAdmin = new Categories($objConnection);
$result1 = $objAdmin->getSubCategory(1);
include 'header.php';?>
<script type="text/javascript">
jQuery(document).ready(function(){	
	$('.pageContent .pageNav li:nth-child(2) ul').css('display','block');
});
</script>
<div class="contentRight">
		<div style="float:left;margin-left:20px;margin-top:20px;margin-bottom:10px;">
			<form action="" method="post" >
					Name:<input type="text" name="empName" value="<?php echo $trialname;?>" />

					Category: <select name="category" style="" class="select">
									<option value="">select</option>
									<?php 	while($row = mysql_fetch_array($result1))
									{?>
									<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
							  		<?php }?>
							  </select>
					     <input type="submit" class="submit button" name="name" value="search" />
			</form>
		</div>
		<div style="float:right;margin-right:20px;margin-top:20px;margin-bottom:10px;"><a href="./trails.php">Add New Trail</a></div>
		<div class="topdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:20px;">ID</div>
			<div class="subdiv" align="left" style="width:80px;">Category</div>
			<div class="subdiv" align="left" style="width:80px;" >List</div>
			<div class="subdiv" align="left" style="width:80px;" >Description</div>
			<div class="subdiv" align="left" style="width:80px;" >Latitude</div>
			<div class="subdiv" align="left" style="width:80px;">Longitude</div>
			<div class="subdiv" align="left" style="width:80px;">No of Images</div>
			<div class="subdiv subdiv_2" align="left">Actions</div>
		</div>
	<?php ?>
		<div  class="listtopdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:20px;"><?php echo $i;?></div>
			<div class="subdiv" align="left" style="width:80px;" ><?php if($row['trail_category_id']==1){echo 'Main Trail';} else if($row['trail_category_id']==2){ echo 'Secondary Trails';}?></div>
			<div class="subdiv" align="left" style="width:80px;" ><?php  echo $row['list'];?></div>
			<div class="subdiv" align="left" style="width:80px; height: 40px;overflow: hidden;" ><?php  echo $row['Description'];?></div>
			<div class="subdiv" align="left" style="width:80px;"><?php  echo $row['latitude'];?></div>
			<div class="subdiv" align="left" style="width:80px;"><?php  echo $row['longitude'];?></div>
			<div class="subdiv" align="left" style="width:80px;"><?php echo $count1; ?></div>
			<div class="subdiv subdiv_2" align="left">
				<a href="./viewTrail.php?rowId=<?php echo $row['id'];?>">View</a>
				<a href="./editTrail.php?rowId=<?php echo $row['id'];?>">Edit</a>
				<a href="./deleteTrail.php?rowId=<?php echo $row['id'];?>" onclick="return confirm('Are you sure?')">Delete</a>
		    </div>
		</div>	
		<div class="subdiv" align="center" style="width:800px;" >No Matches Found!</div>
	
</div>	
<?php include 'footer.php' ;?>
