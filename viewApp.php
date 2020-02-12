<?php
	
	if(isset($_POST['submit1'])){
	 header("location:./appList.php");
	}

	$id = $_REQUEST['rowId'];
	include_once("common.php");
	include_once("class/About_app.Class.php");
	$objIsland = new About_app($objConnection);
	$result = $objIsland->getAppById($id);
	$row_app = mysql_fetch_row($result);
include 'header.php';

if(!empty($row_app)) {
?>
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
		<form action=""  method="post" name="View_aboutApp">
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
		            	<input type="text" name="title" value ="<?php echo $row_app[1];?>"class="textbox_style" readonly />
		            	<br/><label class="err_msg"><?php echo $errorTitle;?></label>
			        </td>
	        </tr>
	         <tr>
		        	<td align="right" class="left"><label>Description</label></td>
		            <td class="right">
		            	<textarea name="description" id="description" class="textarea_style" rows="12" cols="22" readonly='true'><?php echo $row_app[2];?></textarea>
		            	<br/><label class="err_msg"><?php echo $errorDesc;?></label>
			        </td>
	        </tr>
	        <tr>
					<td></td>
					<td>
						<input type="submit" name="submit1" value="BACK">
					</td>
			</tr>
			<tr>
				<td></td>
			</tr>	
		</table>
	</form>			
</div>
<?php 
}
include 'footer.php' ;?>
