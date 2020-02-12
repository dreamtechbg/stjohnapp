<?php
	$id = $_REQUEST['rowId'];
	include_once("common.php");
	include_once("class/AboutIsland.Class.php");
	$objIsland = new AboutIsland($objConnection);
	$result = $objIsland->getIslandById($id);
	$rowIsland = mysql_fetch_array($result);
	if(isset($_POST['submit1'])){
	 header("location:./islandList.php");
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
<?php 
$message='';
$errorTitle='';
$errorDesc='';
?>		
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
		            	<input type="text" name="title" value ="<?php echo $rowIsland['name'];?>"class="textbox_style" readonly/>
		            	<br/><label class="err_msg"><?php echo $errorTitle;?></label>
			        </td>
	        </tr>
	         <tr>
		        	<td align="right" class="left"><label>Description</label></td>
		            <td class="right">
		            	<textarea name="description" id="description" class="textarea_style" rows="4" cols="22"  readonly="yes"><?php echo $rowIsland['description'];?></textarea>
		            	<br/><label class="err_msg"><?php echo $errorDesc;?></label>
			        </td>
	        </tr>
	        <tr>
					<td></td>
					<td>
						<input type="submit" name="submit1" value="BACK">
					</td>
			</tr>
		</table>
	</form>			
</div>
<?php include 'footer.php' ;?>
