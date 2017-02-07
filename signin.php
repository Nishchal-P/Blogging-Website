<?php
define('DB_HOST', "localhost");
define('DB_NAME', "login");
define('DB_USER',"root");
define('DB_PASSWORD',"");

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error($con));
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error($con));



function SignIn()
{
session_start();
if(!empty($_POST['user'])
{       global $con;
	$query = mysqli_query( $con,"SELECT *  FROM registered where userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysql_error($con));
	$row = mysqli_fetch_array($query) ;
	if(!empty($row['userName']) AND !empty($row['pass']))
	{
		$_SESSION['userName'] = $row['pass'];
		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
}
	else
	{
		echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
	}
}
}
if(isset($_POST['submit']))
{
	SignIn();
}

?>
