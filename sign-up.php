<?php
include("config.php");
function NewUser(){
    global $con;
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $username = $_POST['user'];
    $query = "INSERT INTO user VALUES ('$username', '$password', '$firstname', '$lastname', '$age', '$gender', '$email')";
    $data = mysqli_query($con, $query)or die(mysql_error($con));
    if($data){
        echo "Sign-Up Successful!";
    }
}
function SignUp(){
    global $con;
    if(!empty($_POST['user'])){
        $query = mysqli_query($con, "SELECT * FROM user WHERE username='$_POST[user]'") or die(mysql_error($con));
        if(!$row = mysqli_fetch_array($query) or die(mysql_error($con))){
            NewUser();
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
