<?php
include("config.php");
function SignIn(){
	session_start();
	if(!empty($_POST['user'])){
		global $con;
		$query = mysqli_query($con, "SELECT * FROM user WHERE username='$_POST[user]' AND password='$_POST[pass]'") or die(mysql_error($con));
		$row = mysqli_fetch_array($query) ;
		if(!empty($row['username']) AND !empty($row['password'])){
			$_SESSION['username'] = $row['password'];
			echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
		}
		else{
			echo "Invalid Credentials! Please try agin";
		}
	}
}
if(isset($_POST['submit']))
{
	SignIn();
}
?>
