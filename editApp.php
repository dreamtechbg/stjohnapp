<?php
	$id = $_REQUEST['rowId'];
	include_once("common.php");
	include_once("class/About_app.Class.php");
if(empty($message))
$message='';
if(empty($errorTitle))
$errorTitle='';
if(empty($errorDesc))
$errorDesc='';
	$objApp = new About_app($objConnection);
	$result = $objApp->getAppById($id);
	$rowApp = mysql_fetch_array($result);
	if(isset($_POST['submit1'])){
			$error = 0;
		 	$title = $_POST['title'];
		 	$description = $_POST['description'];
		 	if($title == ''){
		 		$errorTitle = "Please Enter a Title";
		 		$error =1;
		 	}
		 	if($description == ''){
		 		$errorDesc = "Please Enter the description";
		 		$error =1;
		 	}
		 	if($error == 0){
		 		//$Description = mysql_real_escape_string($description);
		 		$result = $objApp->updateApp($title, $description,$id);
		 		if($result){
		 			header("location:./appList.php");
		 		}
		 	}
	}
	include 'header.php';?>
	<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
    nicEditors.editors.push(
        new nicEditor().panelInstance(
            document.getElementById('description')
        )
    );
});
//]]>
</script>
<div class="contentRight">		
	<form action="" enctype="multipart/form-data" method="post">
		<table style ="float: left;margin-left: 167px;margin-top: 26px;">
		  <tr>
				  	<td align="right" class="left"></td>
				  	<td class="right">
				  		<label class="err_msg"><h2><?php echo $message; ?></h2></label>
				  	</td>
		  </tr>
		  <tr>
		        	<td align="right" class="left"><label>Title</label></td>
		            <td class="right">
		            	<input type="text" name="title" value ="<?php echo $rowApp['name'];?>"class="textbox_style"/>
		            	<br/><label class="err_msg"><?php echo $errorTitle;?></label>
			        </td>
	        </tr>
	         <tr>
		        	<td align="right" class="left"><label>Description</label></td>
		            <td class="right">
		            	<textarea name="description" id="description" class="textarea_style" rows="4" cols="22" ><?php echo $rowApp['discription'];?></textarea>
		            	<br/><label class="err_msg"><?php echo $errorDesc;?></label>
			        </td>
	        </tr>
	        <tr>
					<td></td>
					<td>
						<input type="submit" name="submit1" value="UPDATE">
					</td>
			</tr>
			<tr>
					<td>
						<a href="appList.php">BACK</a>
					</td>
			</tr>	
		</table>
	</form>			
</div>
<?php include 'footer.php' ;?>
