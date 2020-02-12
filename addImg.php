<?php
	$itemId = $_REQUEST['rowId'];
	$catId = $_REQUEST['catId'];
	$type = $_REQUEST['type'];
	include_once("common.php");
	include_once("class/ItemImage.Class.php");
	include("resize-class.php");
	
	
	if(isset($_POST['submit1'])){
		
			foreach($_FILES as $file){
				  $caption = $_POST['captionimage'];
				 // $caption = mysql_real_escape_string($caption);
				  $size = getimagesize($file["tmp_name"]);
				  $width = $size[0];
				  $height = $size[1];
			      $filename= $file["name"];
			      $newFilename = date('mdYhis').''.$filename;
			       if($filename){
			       /*	if($width>320 && $height>400){
			     		 move_uploaded_file($file["tmp_name"],"upload/".$newFilename);
			     		 $resizeObj = new resize("upload/".$newFilename);
						 $resizeObj -> resizeImage(320, 400, 'exact');
						 $resizeObj -> saveImage("upload/".$newFilename, 100);
			       		 $objImg = new ItemImage($objConnection);
			       		 $result = $objImg->insertImagenew($itemId,$newFilename,$caption);
			       		 header("location:./viewImg.php?itemId=$itemId&catId=$catId;&type=$type");
			       	}else{*/
			       		move_uploaded_file($file["tmp_name"],"upload/".$newFilename);
			       		 $objImg = new ItemImage($objConnection);
			       		 $result = $objImg->insertImagenew($itemId,$newFilename,$caption);
			       		 header("location:./viewImg.php?itemId=$itemId&catId=$catId;&type=$type");
			       /*	}*/
			       }
			 }
		
	}
	include 'header.php';?>
<div class="contentRight">
<div align="center" style="font-weight:bold;"><?php echo $_REQUEST['name']; ?></div>
	<form action="" enctype="multipart/form-data" method="post">
		<table style ="float: left;margin-left: 167px;margin-top: 26px;">
			 <tr>
	        		<td align="right" class="left">
	        			<label for='Image1'>Image </label>
	        		</td>
	        		<td class="right">
	        			<input type="file" id="image" name="image" value=""/>
	        		</td> 	
	        </tr>
	        <tr>
	        		<td align="right" class="left">
	        			<label for='Image1'>Caption </label>
	        		</td>
	        		<td class="right"><input type="text" id="captionimage" name="captionimage" class="textbox_style" value=""/></td>
		   </tr>
		   <tr>
					<td></td>
					<td>
						<input type="submit" name="submit1" value="Save">
					</td>
			</tr>
			 <tr>
					<td>
						<a href="./viewImg.php?itemId=<?php echo $itemId;?>&catId=<?php echo $catId; ?>&type=<?php echo $type; ?>&name=<?php echo htmlspecialchars($_REQUEST['name'], ENT_QUOTES, 'UTF-8');?>">BACK</a>
					</td>
			</tr>
		</table>
	</form>

</div>
<?php include 'footer.php' ;?>
