<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login to WeBlog</title>
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
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				require ('mysqli_connect.php');
				if (!empty($_POST['email'])) {
					$e = mysqli_real_escape_string($dbcon, $_POST['email']);
				}
				else {
					$e = FALSE;
					echo '<p class="error">You forgot to enter your email address.</p>';
				}
				if (!empty($_POST['password'])) {
					$p = mysqli_real_escape_string($dbcon, $_POST['password']);
				} else {
					$p = FALSE;
					echo '<p class="error">You forgot to enter your password.</p>';
				}
				if ($e && $p){
					$q = "SELECT id as user_id, username, user_level FROM users WHERE (email='$e' AND password='$p')";
					$result = mysqli_query ($dbcon, $q);
					if (mysqli_num_rows($result) == 1) {
						session_start();
						$_SESSION = mysqli_fetch_array ($result);
						$_SESSION['user_level'] = (int) $_SESSION['user_level'];
						$_SESSION['user_id'] = (int) $_SESSION['user_id'];
						$url = ($_SESSION['user_level'] == 2) ? 'admin-page.php' : 'members-page.php';
						header('Location: ' . $url);
						exit();
						mysqli_free_result($result);
						mysqli_close($dbcon);
					}
					else {
						echo '<p class="error">The email address and password entered do not match our records.<br>Perhaps you need to register, click the Register button on the header menu</p>';
					}
				}
				else {
					echo '<p class="error">Please try again.</p>';
				}
				mysqli_close($dbcon);
			}
			?>
			<div id="center">
				<h2>Login</h2>
				<form action="login.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-6" for="email">Email:</label>
						<div class="col-sm-6">
							<input class="form-control" id="email" type="text" name="email" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6" for="password">Password:</label>
						<div class="col-sm-6">
							<input class="form-control" id="password" type="password" name="password" maxlength="20" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" >
						</div>
					</div>
					<div class="form-group">
			      		<button type="submit" class="btn btn-default" name="submit">Login</button>
			    	</div>
				</form>
			</div>
			<?php include ('footer.php'); ?>
		</div>
</body>
</html>
