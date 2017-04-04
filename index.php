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
		<div class="col-sm-12">
			<div class="col-sm-11">
				<div class="jumbotron">
					<h1>Welcome to WeBlog!</h1>
					<p>WeBlog is blogging website where people share their daily experiences, opinions and technical knowledge with like-minded people.</p>
				</div>
			</div>
		</div>
		<h4>Recent Posts:-</h4>
		<?php
		require("mysqli_connect.php");
		$query = "SELECT id, title, content, user_id, DATE_FORMAT(posted,'%M %e ,%Y') AS date_posted FROM post ORDER BY id DESC";
		$result = mysqli_query($dbcon, $query);
		if(@mysqli_num_rows($result) == 0){
			echo 'There are no posts yet.';
		}
		else{
			$i=0;
			while($rows = mysqli_fetch_array($result) and $i<6){
				$i++;
				$uid = $rows['user_id'];
				$q2 = "SELECT username FROM users WHERE id=$uid";
				$res2 = mysqli_query($dbcon, $q2);
				$row2 = mysqli_fetch_array($res2);
				echo '<div class="col-sm-10">
					<a href="view_post.php?id=' . $rows['id'] . '" id="well-anchor">
					<div class="well">
						<div class="media">
							<div class="media-body">
								<div class="media-heading">
									<text style="font-size: 150%">'. $rows['title']. '</text> by '. $row2['username']. '
								</div>
								<p>'. substr($rows['content'], 0, 50) . (strlen($rows['content'])>50? '...' : ' ') . '</p>
								<ul class="list-inline list-unstyled">
								<li><span><i class="glyphicon glyphicon-calendar"></i> '. $rows['date_posted']. ' </span></li>
								<li>|</li><li> </li>';
								$pid = $rows['id'];
								$q3 = "SELECT COUNT(id) AS count_id FROM comment WHERE post_id=$pid";
								$res3 = mysqli_query($dbcon, $q3);
								$row3 = mysqli_fetch_array($res3);
								echo '<span><i class="glyphicon glyphicon-comment"></i> ' . $row3["count_id"] . ' comment' . ($row3["count_id"]==1? '': 's') . '</span>
								</ul>
							</div>
						</div>
					</div>
					</a>
				</div>';
			}
		}
		?>
		<?php include("footer.php"); ?>
	</div>
</body>
</html>
