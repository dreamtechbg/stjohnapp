<?php include 'header.php';
$id = $_REQUEST['rowId'];
$error = 0;
include_once("common.php");
include_once("class/Admin.Class.php");
		$objAdmin = new Admin($objConnection);
 		$admin = $objAdmin->getPassword($id);
		$date = date('Y-m-d H:i:s');?>
<?php while($row = mysql_fetch_array($admin)){
  	$pass = $row['password'];  	
	}if(isset($_POST['submit'])){
	$error = 0;
	$oldPass = $_POST['txtOldPassword'];
	$newPass = $_POST['txtNewPassword'];
	$confirmPass = $_POST['txtConfirmPassword'];
	$oldPassNew = md5($oldPass);
	if($pass!=$oldPassNew){
		$errorOld = "Incorrect Password";
		$error = 1;
	}else if($newPass == ''){
		$errorNew = "Enter the new Password";
		$error = 1;
	}else if($newPass!=$confirmPass){
		$errorPass = "confirm Password does't match";
		$error = 1;
	}
	if($error == 0){
		$objAdmin1 = new Admin($objConnection);
		$newPass1 = md5($newPass);
		$admin1 = $objAdmin1->updatePassword($newPass1,$date,$id);
		if($admin1==true){
		$success="You Have Successfully Changed The Password";
		}
	}
}?>
<div class="contentRight">
<?php 
$errorOld='';
$errorNew='';
$errorPass='';
$success='';
?>
		<form action="" method="post">
				<table width="100%" cellpadding="0" cellspacing="0">
						<tr><tr><td class="adminhead" ><center><h4>Admin Details</h4></center></td></tr>
				</table>
					<table style="margin-left:200px;">
								<tr><td style="color:green;" colspan="2"><center> <small><?php echo $success;?></small></center></td></tr>
								<tr>
						        	<td align="right" class="left"><label>Old Password</label></td>
						            <td class="right">
						            	<input type="password" class="textbox_style" name="txtOldPassword" value="">
						            	<br/><label class="err_msg"><?php echo $errorOld;?></label>
							        </td>
						        </tr>
						        <tr>
						        	<td align="right" class="left"><label>New Password</label></td>
						            <td class="right">
						            	<input type="password" class="textbox_style" name="txtNewPassword" value="">
						            	<br/><label class="err_msg"><?php echo $errorNew;?></label>
							        </td>
						        </tr>
						        <tr>
						        	<td align="right" class="left"><label>Confirm Password</label></td>
						            <td class="right">
						            	<input type="password" class="textbox_style" name="txtConfirmPassword" value="">
						            	<br/><label class="err_msg"><?php echo $errorPass;?></label>
							        </td>
						        </tr>
						        <tr>
									<td></td>
									<td>
										<input type="submit" name="submit" value="Save">
										<a href="./home.php"><input type="button" name="cancel" value="Cancel"/></a>
									</td>
								</tr>
					</table>
		</form>
</div>	
<?php include 'footer.php' ;?>
