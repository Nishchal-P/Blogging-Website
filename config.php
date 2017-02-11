<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'blog');
define('DB_USER', 'blog_user');
define('DB_PASSWORD', 'blog_user');
$con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error($con));
$db=mysqli_select_db($con, DB_NAME) or die("Failed to connect to MySQL: " . mysql_error($con));
?>
