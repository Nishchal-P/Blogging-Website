<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Remove - Admin</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("header.php"); ?>
	<?php include("nav.php"); ?>
    <div id="container">
        <?php
        require("mysqli_connect.php");
        if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2))
        {
            header("Location: index.php");
            exit();
        }
        if ($_GET['post'] != NULL){
            $pid = $_GET['post'];
            $query = "DELETE FROM post WHERE id=$pid";
            $result = mysqli_query($dbcon, $query);
            if($result){
                echo '<p>Post with id ' . $pid . ' successfully removed.</p>';
            }
            else{
                echo '<p>Error occurred while removing post. Post could not be successfully removed</p>';
            }
        }
        if ($_GET['user'] != NULL){
            $uid = $_GET['user'];
            $query = "DELETE FROM users WHERE id=$uid";
            $result = mysqli_query($dbcon, $query);
            if($result){
                echo '<p>User with id ' . $uid . ' successfully removed.</p>';
            }
            else{
                echo '<p>Error occurred while removing user. User could not be successfully removed.</p>';
                echo mysqli_error($dbcon);
            }
        }
        ?>
    </div>
