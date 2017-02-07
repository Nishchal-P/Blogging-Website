<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'login');
define('DB_USER','root');
define('DB_PASSWORD','');
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error($con));
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error($con));

function NewUser() {
  global $con;
$firstname = $_POST['fname'];
$lastname= $_POST['lname'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$email = $_POST['email'];
$password = $_POST['pass'];
$username=$_POST['user'];
$query = "INSERT INTO registered (firstname,lastname,age,gender,email,pass,userName) VALUES ('$firstname','$lastname','$age','$gender','$email','$password','$username')";
$data = mysqli_query ($con,$query)or die(mysql_error($con));

if($data) {
 echo "YOUR REGISTRATION IS COMPLETED..."; }
 }


function SignUp()
{ global $con;
if(!empty($_POST['user']))
 { $query = mysqli_query($con,"SELECT * FROM registered WHERE userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysqli_error($con));

   if(!$row = mysqli_fetch_array($con,$query) or die(mysqli_error($con)))
{
 newuser();
}
 else { echo "SORRY...YOU ARE ALREADY REGISTERED USER..."; } } }



if(isset($_POST['submit']))

{ SignUp(); } ?>
