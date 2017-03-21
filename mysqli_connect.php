<?php
//Setting credentials for MySQL login
DEFINE ('DB_USER', 'blog_user');
DEFINE ('DB_PASSWORD', 'blog_user');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'blog');

// Connect to MySQL
$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set encoding
mysqli_set_charset($dbcon, 'utf8');
?>
