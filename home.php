<?php 
//$error=0;
include 'header.php';
include_once("common.php");
include_once("class/Admin.Class.php");
 $user= $_SESSION['views'];
 		$objAdmin = new Admin($objConnection);
 		$admin = $objAdmin->adminDetails($user);
    if(empty($errorName))
    $errorName="";
if(empty($errorEmail))
    $errorEmail="";

		if(isset($_POST['submit'])){
		
			//$error = 0;
			$id = $_POST['id'];
			$adminname = $_POST['txtName'];
			$adminemail = $_POST['txtEmail'];
			$objAdmin1 = new Admin($objConnection);
			if($adminname==''){
				 $errorName = "Please Enter Admin Name";
				 $error = 1;
			}
			if($adminemail == ''){
				$errorEmail = "Please Enter the admin Email";
				$error = 1;
			}else if(filter_var($adminemail, FILTER_VALIDATE_EMAIL) === false){
				$errorEmail = "Please Enter a valid Email";
				$error = 1;
			}
			if($error == 0){
				
 				$admin1 = $objAdmin->updateAdmin($adminname,$adminemail,$id);
				
 				if($admin1){
 					header("Location:./home.php");
 				}
			}
		}
?>

<div class="contentRight">

		<form action="" method="post">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr><tr><td class="adminhead" ><center><h4>Admin Details</h4></center></td></tr>
			</table>
			<table style="margin-left:250px;">
			<?php while($row = mysql_fetch_array($admin)){?>
				<tr>
		        	<td align="right" class="left"><label>Username : </label></td>
		            <td class="right">
		            	<?php echo $_SESSION['views']; ?>            	
			        </td>
		        </tr>
		        <tr>
		        	<td align="right" class="left"><label>Name : </label></td>
		            <td class="right">
		            	<input type="text" class="textbox_style" name="txtName" value="<?php  echo $row['name'];?>">
		            	<br/><label class="err_msg"><?php echo $errorName;?></label>
			        </td>
		        </tr>
		        <tr>
		        	<td align="right" class="left"><label>Email : </label></td>
		            <td class="right">
		            	<input type="text" class="textbox_style" name="txtEmail"  value="<?php  echo $row['email'];?>">
		            	<br/><label class="err_msg"><?php echo $errorEmail;?></label>
			        </td>
		        </tr>
		        <tr>
		        	<td align="right" class="left"><label>Last Login : </label></td>
		            <td class="right"><?php  echo $row['created_at'];?>
		            </td>
		        </tr>
		        <tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Save">
						<input type = "hidden" name = "id" value="<?php  echo $row['id'];?>"/>
						<br/><br/>
						<a href="./changePass.php?rowId=<?php echo $row['id'];?>">Change Password</a>
					</td>
				</tr>
				<?php }?>
			</table>
		</form>
</div>
<?php include 'footer.php' ;?>
