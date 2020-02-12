<?php
	include_once("common.php");
	include_once("class/ItemImage.Class.php");
	include("resize-class.php");
	$imgId = $_REQUEST['imageId'];
	$itemId = $_REQUEST['rowId'];
	$catId = $_REQUEST['catId'];
	$type = $_REQUEST['type'];
	
	if(isset($_POST['submit1'])){
		$error = 0;
		$caption = $_POST['caption'];
		if($caption==''){
		     $errorCaption = "Please Enter A Caption";
 		     $error = 1;
		}
		if($error == 0){
			$objImg = new ItemImage($objConnection);
			$size = getimagesize($_FILES["file"]["tmp_name"]);
			$width = $size[0];
			$height = $size[1];
			$filename = $_FILES["file"]["name"];
			$newFilename = date('mdYhis').''.$filename;
			if($filename){
				/*if($width>320 && $height>400){
					 move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newFilename);
					 $resizeObj = new resize("upload/".$newFilename);
					 $resizeObj -> resizeImage(320, 400, 'exact');
					 $resizeObj -> saveImage("upload/".$newFilename, 100);
					 $result = $objImg->updateImage($imgId,$caption,$newFilename);
				}else{*/
		       		 move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newFilename);
		       		 $objImg = new ItemImage($objConnection);
		       		 $result = $objImg->updateImage($imgId,$caption,$newFilename);
			 /*   }*/
				 if($result){
				 	header("location:./viewImg.php?itemId=$itemId&catId=$catId&type=$type");;
				 }
			}else{
				$objImg = new ItemImage($objConnection);
				$result = $objImg->updateImageNew($imgId,$caption);
				if($result){
					header("location:./viewImg.php?itemId=$itemId&catId=$catId&type=$type");
				}
			}
			
		}
	}
	include 'header.php';?>
<div class="contentRight">
<div align="center" style="font-weight:bold;"><?php echo $_REQUEST['name']; ?></div>	
	<form action="" enctype="multipart/form-data" method="post">
		<table style ="float: left;margin-left: 167px;margin-top: 26px;">
		<?php 	$objImg = new ItemImage($objConnection);
				$result1 = $objImg->getImgByPk($imgId);
				while($row = mysql_fetch_array($result1)){
					  $img = $row['image'];?> 
						<tr>
							<td>Image</td>
							<td>
								    	<img src="upload/<?php echo $img;?>"  height="200" width="300">    
							</td>
							<td><input type = "file" name ="file" id ="file"/></td>
					    </tr>
					    <tr>
					    	<td align="right" class="left"><label>Caption</label></td>
		            		<td class="right">
		            			<input type="text" name="caption" value ="<?php  echo $row['caption'];?>"class="textbox_style" />
		            		<br/><label class="err_msg"><?php echo $errorCaption;?></label>
			        		</td>
					    </tr>
		    <?php }?>
		    			<tr>
		    				<td></td>
							<td>
								<input type="submit" name="submit1" value="Save and Continue">	
		    				</td>
		    			</tr>
		    			<tr>
		    				<td><a href="./viewImg.php?itemId=<?php echo $itemId;?>&catId=<?php echo $catId; ?>&type=<?php echo $type; ?>&name=<?php echo htmlspecialchars($_REQUEST['name'], ENT_QUOTES, 'UTF-8');?>">BACK</a></td>
		    			</tr>
		</table>
	</form>
</div>
<?php include 'footer.php' ;?>
