<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<?php include("header.php"); ?>
  	<?php include("nav.php"); ?>
	<div id="container">
		<div class="row">
			<div class="col-sm-10">
				<h1 class="page-header">About Us
					<small>It's Nice to Meet You!</small>
				</h1>
				<p font-size=20px>We at <strong>WeBlog</strong> provides you  the best platform where you can express your ideas and get help from others sitting across the globe.</p>
			</div>
		</div>
		<div class="col-sm-12">
			<h2 class="page-header">Our Team</h2>
		</div>
		<div class="col-sm-3  text-center">
			<img class="img-circle img-responsive img-center " src="http://placehold.it/200x200" alt="">
			<h3 >Akhil Powar
				<small>B.Tech (Computer)</small>
			</h3>
		</div>
		<div class="col-sm-3  text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3 >Praveen Kumar Suthar
				<small>B.Tech (Computer)</small>
			</h3>
		</div>
		<br>
		<?php include("footer.php");?>
	</div>
</body>
</html>
