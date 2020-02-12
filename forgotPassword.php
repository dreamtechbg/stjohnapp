<?php session_start();
include_once("common.php");
include_once("class/Admin.Class.php");
 if(isset($_POST['submit'])){
		$error = 0;
		$userEmail = $_POST['txtEmail'];
		$objAdmin = new Admin($objConnection);
		$admin = $objAdmin->adminEmail($userEmail);
		if($userEmail==''){
		     $errorEmail = "Please Enter your Email";
 		     $error = 1;
		}
		$row = mysql_fetch_array($admin);
		$id = $row['id'];
		$user = $row['username'];
		$date = date('Y-m-d H:i:s');		
		$count=mysql_num_rows($admin);
		if($error == 0){
					if($count>=1) 
						{
								function generateRandomString($length = 10) {    
		    							return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
								} 
								$newPass = generateRandomString();
								$newPassmd5 =md5($newPass);
								$result = $objAdmin->updatePassword($newPassmd5,$date,$id);
								$to = $userEmail;
								$subject = "ChangePassword-TrailMasters Admin";
								$message = "<html><body><div>Hello! Admin"."</div><br/>"." Your UserName  ".$user."<br/>"." New Password: ".$newPass."</body></html>";
									
								//$from = "development@zoondia.in";
								$from =	$userEmail;
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From:" . $from. "\r\n";
								mail($to, $subject, $message, $headers);
								$successMessage = "Check Mail for new Password.";
								
						}
						else{
							$errorEmail = "Incorrect Email";
						}
				}				
		}?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login | Trail Master</title>
        <link rel="icon" href="favicon.png" type="image/png" />
        <script src="js/scripts.js" type="text/javascript"></script>
        <!--[if IE 6]><script src="js/ie6.js" type="text/javascript"></script><![endif]-->
        <style type="text/css">@import url("css/styles.css");</style>
    </head>

    <body>
	    <section id="container">
			<div class="loginBox">
				<span class="loginTitle">
					<img src="images/imgLogin.png" />
				<br/>	<span style="color:green;margin-right:100px;"><?php echo $successMessage; ?></span>
						<span class="errorMail"><?php echo $errorEmail; ?></span>
				</span>
					<div class="loginWrap">
				  		<form method="post" action="">
				            <div class="loginField queryInput">
				                <label for="userName" >Email</label>
				                <input id="txtEmail" type="text" name="txtEmail" value = "<?php echo $_POST['txtEmail']; ?>" autocomplete="off">
				            </div>
				            <input id="btnSubmit" type="submit" value="Submit" name = "submit" title="Login">
				            <a style="margin-left:110px;" href="index.php">Login In</a>
				        </form> 
				   </div>
			</div>
		</section>
	</body>
</html>
