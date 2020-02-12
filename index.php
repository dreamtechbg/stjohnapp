<?php session_start();
//$error = 0;
include_once("common.php");
include_once("class/Admin.Class.php");
     if(empty($errorName))
    $errorName="";
     if(empty($errorPass))
    $errorPass="";
     if(empty($errorMatch))
    $errorMatch="";
     if(empty($_POST['txtUsername']))
    $_POST['txtUsername']="";
     if(empty($_POST['txtPassword']))
    $_POST['txtPassword']="";
 if(isset($_POST['submit'])){
		//$error = 0;
		$count = 0;
		$username = $_POST['txtUsername'];
		$password = $_POST['txtPassword'];
		$objAdmin = new Admin($objConnection);
		$pass = md5($password);
		$admin = $objAdmin->adminLoginCkeck($username,$pass);
		$date = date('Y-m-d H:i:s');
		if($_POST['txtUsername']==''){
		     $errorName = "Please enter User Name";
		    // $errorMatch="";
		    // $errorPass="";
 		     $error = 1;
		}else if(!preg_match('/^[a-zA-Z0-9]*$/',$username)){
		     $errorName = "Invalid Username";
		    // $errorMatch="";
		    // $errorPass="";
	 	     $error = 1;
		}		
		if($_POST['txtPassword']==''){
		     $errorPass = "Please enter Password";
		    // $errorMatch="";
		   //  $errorName="";
 		     $error = 1;
		}
		$count=mysql_num_rows($admin);
		if($error == 0){
					if($count==1) 
						{
							$result = mysql_query("UPDATE `admin` SET created_at='$date' WHERE username ='$username' AND password ='$pass'");
							$_SESSION['views']=$username;
							header("Location:./home.php");
							}else{
							$errorMatch = "Invalid User Name/Password";
							$_POST['txtUsername']="";
							$_POST['txtPassword']="";	
							$errorPass="";
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
				</span>
					<div class="loginWrap">
			  		<form method="post" action="">
			            <div class="loginField queryInput">
			                <label for="userName" >Login</label>
			                <input id="userName" type="text" name="txtUsername" value = "<?php echo $_POST['txtUsername']; ?>" autocomplete="off">
			                <div class="errorMsg"><?php echo $errorName; ?></div>
			            </div>
			            <div class="loginField queryInput">    
			                <label for="pword" >Password</label>
			                <input id="pword" type="password" name="txtPassword" value="<?php echo $_POST['txtPassword']; ?>" autocomplete="off">
			               <div class="errorMsg" ><?php echo $errorPass; ?></div>
			               <div class="errorInvalid"><?php echo $errorMatch; 


?></div>
			            </div>  
			            <input id="btnSubmit" type="submit" value="Submit" name = "submit" title="Login">
			            <a style="margin-left:110px;" href="forgotPassword.php">Forgot Password?</a> 
			        </form> 
					
				</div>
			</div>
	</section>
	</body>
</html>