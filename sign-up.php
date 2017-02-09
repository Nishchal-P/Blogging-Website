<?php
include("config.php");
function NewUser() {
   global $con;
   $firstname = $_POST['fname'];
   $lastname= $_POST['lname'];
   $age=$_POST['age'];
   $gender=$_POST['gender'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $username=$_POST['username'];
   $query = "INSERT INTO user (firstname,lastname,age,gender,email,password,username) VALUES ('$firstname','$lastname','$age','$gender','$email','$password','$username')";
   $data = mysqli_query ($con,$query)or die(mysql_error($con));
   if($data) {
      echo "YOUR REGISTRATION IS COMPLETED...";
   }
}
function SignUp(){
   global $con;
   if(!empty($_POST['username'])){
      $query = mysqli_query($con,"SELECT * FROM user WHERE username = '$_POST[username]' AND password = '$_POST[password]'") or die(mysqli_error($con));
      if(!$row = mysqli_fetch_array($con,$query) or die(mysqli_error($con))){
         newuser();
      }
      else{
         echo "Sorry! It seems this name is already taken!";
      }
   }
}
if(isset($_POST['submit'])){
   SignUp();
}
?>
