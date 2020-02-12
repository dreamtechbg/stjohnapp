<?php
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$message=$_REQUEST['message'];
include_once("common.php");
include_once("class/Admin.Class.php");
$objAdmin = new Admin($connection);
$result = $objAdmin->getAdminEmail();
$row = mysql_fetch_array($result);
$adminEmail = $row['email'];
if(($name!='')&&($email!='')&&($message!='')){
	email($adminEmail,$name,$email,$message);
}else{
	echo 'no';
}


//*******Email Function*******//
	function email($adminEmail,$name,$email,$message){
			$to = $adminEmail;
			$subject = "Contact Details of  ".$name;
			$message = "<html><body><div>Hello! Admin"."</div><br/>"." There is a contact from ".$name."<br/>"."  email: ".$email."<br/> Message:   ".$message."</body></html>";
				
			$from = $email;
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From:" . $from. "\r\n";
			mail($to, $subject, $message, $headers);
			$successMessage = "yes";
			echo $successMessage;
	}