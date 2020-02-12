
<?php
include_once("common.php");
include_once("class/Categories.Class.php");
include_once("class/Items.Class.php");
include_once("class/ItemImage.Class.php");
$catId = $_REQUEST['catId'];
$type = $_REQUEST['type'];
//$pageNo = $_REQUEST['page'];
if(!empty($_REQUEST['page']))
	$pageNo = $_REQUEST['page'];
	else
	$pageNo = 1;
if(!empty($_REQUEST['category']))
	$searchCat = $_REQUEST['category'];
	else
	$searchCat = null;
//$searchCat = $_REQUEST['category'];

//if(!isset($pageNo))
//$pageNo = 1;

$objAdmin = new Categories($objConnection);
$heading = $objAdmin->getCatName($catId);
$subCount = $objAdmin->getSubCategory($catId);
$countCat =  mysql_num_rows($subCount);
$subCat = $objAdmin->getSubCategory($catId);
$subResult = $objAdmin->getSubCategory($catId);
$objItem= new Items($objConnection);
$objItemImages = new ItemImage($objConnection);
$entryCount = 0;
if(!empty($_REQUEST['itemName']))
$itemName = $_REQUEST['itemName'];
else
$itemName = null;
if(!empty($_REQUEST['category']))
$category = $_REQUEST['category'];
else
$category = null;
//$itemName = $_REQUEST['itemName'];
//$category = $_REQUEST['category'];
if(isset($_POST['search']) || ($itemName != '') || ($category != '')){
	$flag = 1;	
	if(isset($_POST['search']))		
		$pageNo = 1;
}
else
	$flag=0;
$array = array();

include 'header.php';?>
<script type="text/javascript">
jQuery(document).ready(function(){	
	$('.pageContent .pageNav li:nth-child(<?php echo $_REQUEST['type']?>) ul').css('display','block');
});
</script>
<?php 
$headings = mysql_fetch_array($heading);?>
<div class="contentRight">
<div style="float:left;margin-left:20px;">
		<?php 
		if($type==3)
		{
		echo"<form method=\"post\" action=\"randomize.php\">
		<input type=\"hidden\" value=\"$catId\" name=\"cid\">
		<input type=\"hidden\" value=\"$type\" name=\"subtype\">
<input type=\"submit\" name=\"submit\" value=\"Randomize\">
</form>";
		}
		?>
<h2 style="float:left;margin-left:220px;margin-top:20px;margin-bottom:10px;"><?php echo $headings['type']?> > <?php echo $headings['name']?></h2>
		<div style="float:left;margin-left:20px;margin-top:20px;margin-bottom:10px;">
			<form action="" method="post" >
					Name:<input type="text" name="itemName" value="<?php echo $itemName;?>" />
					<?php if($countCat){?>
					Category: <select name="category" style="" class="select">
									<option value="">select</option>
									<?php 	while($row3 = mysql_fetch_array($subResult))
									{	$array[] = $row3['id'];
										 ?>
									<option <?php if($searchCat == $row3['id']) { echo 'selected'; }?> value="<?php echo $row3['id'];?>"><?php echo $row3['name'];?></option>
							   <?php }?>
							  </select>
					<?php  }?>
					     <input type="submit" class="submit button" name="search" value="search" />
			</form>
		</div>
		<div style="float:right;margin-right:20px;"><a href="./addItem.php?type=<?php echo $type;?>&catId=<?php echo $catId;?>">Add New Item</a></div><br/>
		<?php //if($countCat){?>
		<div style="float:right;margin-right:20px;margin-top:20px;margin-bottom:10px;"><a href="./ViewCat.php?type=<?php echo $type;?>&catId=<?php echo $catId;?>">View Category</a></div>
		<?php  //}?>
		<div class="topdiv" id="searchheader">
			<div class="subdiv" align="left" style="width:20px;">SlNo</div>
			<div class="subdiv" align="left" style="width:80px;">Category</div>
			<div class="subdiv" align="left" style="width:80px;" >Name</div>
			<div class="subdiv" align="left" style="width:80px;" >Latitude</div>
			<div class="subdiv" align="left" style="width:80px;">Longitude</div>
			<div class="subdiv" align="left" style="width:80px;">No of Images</div>
			<?php if(!isset($_POST['search']) && $type==2)  {?>
			<div class="subdiv" align="left" style="width:80px;">Sort</div>
			<?php }?>
			<div class="subdiv subdiv_2" align="left">Actions</div>
		</div>
		
		<?php 
		
			if(($flag == 0) || ($itemName == '' && $category == '')) {
				
		?>
		
		
		<?php 
			$count = 0;
			if($countCat){

					if (!isset($_GET['start'])) $start = 1; 
					else $page = $_GET['start'];
					
					$slno = 0;
					 while($catRow = mysql_fetch_array($subCat)){
					 	
						$itemResult = $objItem->getItemsNew($catRow['id'],$catId);
						//$itemResult = $objItem->getItems($catId);
						if($searchCat == '')
							$searchCount = 0;
						else
							$searchCount = $objItem->getCount($catRow['id']);
						
						while($itemRow = mysql_fetch_array($itemResult)){
							$entryCount++;
							$count++;
							$slno++;
							$imgNum = $objItemImages->countImagenew($itemRow['id']);
							$resultCount = mysql_fetch_array($imgNum);
							
							if($entryCount <= $pageNo*10 && $entryCount > ($pageNo-1)*10) {
								
								if(($searchCat == '') ||  (isset($searchCat) && ($searchCat==$itemRow['category_id']))) {
				?>
					
						<div  class="listtopdiv" id="searchheader">
							<div class="subdiv" align="left" style="width:20px;"><?php echo $slno;?></div>
							<div class="subdiv" align="left" style="width:80px;" ><?php if($catId == $itemRow['category_id'])echo $headings['name']; else echo $catRow['name'];?></div>
							<div class="subdiv" align="left" style="width:80px;" ><?php echo $itemRow['name'];?></div>
							<div class="subdiv" align="left" style="width:80px;"><?php echo $itemRow['latitude'];?></div>
							<div class="subdiv" align="left" style="width:80px;"><?php echo $itemRow['lognitude'];?></div>
							<div class="subdiv" align="left" style="width:80px;"><?php echo $resultCount['Num_images'];?></div>
<?php if($type==2)
										{
										?>
										<div class="subdiv" align="left" style="width:80px;"><a class="btnup" title="move up" href="moveup.php?id=<?php echo $itemRow['id'];?>&cid=<?php echo $catId;?>&subtype=<?php echo $type;?>">&#8743;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btndown" title="move down" href="movedown.php?id=<?php echo $itemRow['id'];?>&cid=<?php echo $catId;?>&subtype=<?php echo $type;?>">&#8744;</a></div>										
										<?php }?>
							<div class="subdiv subdiv_2" align="left">
								<a href="./viewItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>&name=<?php echo htmlspecialchars($itemRow['name'], ENT_QUOTES, 'UTF-8');?>">View</a>
								<a href="./editItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>&name=<?php echo htmlspecialchars($itemRow['name'], ENT_QUOTES, 'UTF-8');?>">Edit</a>
								<a href="./deleteItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>" onclick="return confirm('Are you sure?')">Delete</a>
						    </div>
						</div>
								
		<?php				
								}else{
									$entryCount--;
								}
							} 
						}
				} 
			}else{
					$slno = 0;
				
					$itemResult = $objItem->getItems($catId);
					while($itemRow = mysql_fetch_array($itemResult)){
							$entryCount++;
							$slno++;
							$count++;
							$imgNum = $objItemImages->countImagenew($itemRow['id']);
							$resultName = $objAdmin->getCatName($catId);
							$rowName = mysql_fetch_array($resultName);
							$resultCount = mysql_fetch_array($imgNum);
							if($entryCount <= $pageNo*10 && $entryCount > ($pageNo-1)*10){
								if(!isset($searchCat) ||  (isset($searchCat) && ($searchCat==$itemRow['category_id']))) {
				?>
								<div  class="listtopdiv" id="searchheader">
										<div class="subdiv" align="left" style="width:20px;"><?php echo $slno;?></div>
										<div class="subdiv" align="left" style="width:80px;" ><?php echo $rowName['name'];?></div>
										<div class="subdiv" align="left" style="width:80px;" ><?php echo $itemRow['name'];?></div>
										<div class="subdiv" align="left" style="width:80px;"><?php echo $itemRow['latitude'];?></div>
										<div class="subdiv" align="left" style="width:80px;"><?php echo $itemRow['lognitude'];?></div>
										<div class="subdiv" align="left" style="width:80px;"><?php echo $resultCount['Num_images'];?></div>
<?php if($type==2)
										{
										?>
										<div class="subdiv" align="left" style="width:80px;"><a class="btnup" title="move up" href="moveup.php?id=<?php echo $itemRow['id'];?>&cid=<?php echo $catId;?>&subtype=<?php echo $type;?>">&#8743;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btndown" title="move down" href="movedown.php?id=<?php echo $itemRow['id'];?>&cid=<?php echo $catId;?>&subtype=<?php echo $type;?>">&#8744;</a></div>										
										<?php }?>
										<div class="subdiv subdiv_2" align="left">
											<a href="./viewItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>">View</a>
											<a href="./editItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>">Edit</a>
											<a href="./deleteItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>" onclick="return confirm('Are you sure?')">Delete</a>
									    </div>
									</div>	
		<?php				
								}else{
									$entryCount--;
								}
							} 
					}
			}
			}else {
				$count = 0;
				
				if($itemName != '' && $category != ''){ 
					$itemResult = $objItem->search($category, $itemName);
				}
				else if($itemName == '' && $category != ''){ 					
					$itemResult = $objItem->getItems($category);					
				}
				else if($itemName != '' && $category == ''){ 
					
					if($countCat){
						$itemResult = $objItem->searchByItems($array, $itemName);				
					}else {
						$itemResult = $objItem->search($catId, $itemName);
					}
					//$itemResult = $objItem->search($catId, $itemName);
				} 
				
				while($itemRow = mysql_fetch_array($itemResult)){
					
					$entryCount++;
							$slno++;
							$count++;
							$imgNum = $objItemImages->countImagenew($itemRow['id']);
							$resultName = mysql_fetch_array($objAdmin->getCatName($itemRow['category_id']));
							
							$resultCount = mysql_fetch_array($imgNum);
							if($entryCount <= $pageNo*10 && $entryCount > ($pageNo-1)*10){
								
				?>
								<div  class="listtopdiv" id="searchheader">
										<div class="subdiv" align="left" style="width:20px;"><?php echo $slno;?></div>
										<div class="subdiv" align="left" style="width:80px;" ><?php echo $resultName['name'];?></div>
										<div class="subdiv" align="left" style="width:80px;" ><?php echo $itemRow['name'];?></div>
										<div class="subdiv" align="left" style="width:80px;"><?php echo $itemRow['latitude'];?></div>
										<div class="subdiv" align="left" style="width:80px;"><?php echo $itemRow['lognitude'];?></div>
										<div class="subdiv" align="left" style="width:80px;"><?php echo $resultCount['Num_images'];?></div>
										<div class="subdiv subdiv_2" align="left">
											<a href="./viewItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>">View</a>
											<a href="./editItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>">Edit</a>
											<a href="./deleteItem.php?rowId=<?php echo $itemRow['id']?>&catId=<?php echo $catId;?>&type=<?php echo $type;?>" onclick="return confirm('Are you sure?')">Delete</a>
									    </div>
									</div>	
		<?php				
								
							} 
					
				}
				?>
				
				
				
				
				
				
				<?php
			}
			?>
			<?php if($count == 0){?>
					<div class="subdiv" align="center" style="width:731px; border: 0px none;" ><br/>No Matches Found!</div>
			<?php }?>
			<?php /************Pagination********************/?>
		<div style="float: right;margin-bottom: 12px;margin-top: 10px;margin-right: 357px;">
				 <?php 
				 
				   	$pages = ceil($entryCount/10);
				   	
				   	
				   	
				    for ($i = 1;$i <= $pages ;$i++) {
				  
				 ?>
				    	<a href = "./catList.php?catId=<?php echo $catId; ?>&type=<?php echo $type; ?>&page=<?php echo $i ?><?php if($searchCat) echo '&category='.$searchCat;?><?php if($itemName)echo '&itemName='.$itemName; ?>"><?php echo $i ?></a>  
				    	
				 <?php
					 }  
				  	 
				 ?>
	       
	 	</div>
	 <?php /************Pagination********************/?>
</div>	
<?php include 'footer.php' ;?>
