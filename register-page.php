<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register-WeBlog</title>
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
		require ('mysqli_connect.php');
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = array();
			if (empty($_POST['user'])) {
				$errors[] = 'You forgot to enter your username.';
			} else {
				$u = mysqli_escape_string($dbcon,trim($_POST['user']));
			}
			if (empty($_POST['email'])) {
				$errors[] = 'You forgot to enter your email address.';
			} else {
				$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
				if(!filter_var($e, FILTER_VALIDATE_EMAIL)){
					$errors[] = 'Entered e-mail format is invalid.';
					$e = FALSE;
				}
			}
			if (!empty($_POST['psword1'])) {
				if ($_POST['psword1'] != $_POST['psword2']) {
					$errors[] = 'Your two passwords did not match.';
				} else {
					$p = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
				}
			} else {
				$errors[] = 'You forgot to enter your password.';
			}
			if (empty($errors)) {
				$q = "INSERT INTO users (username, email, password, join_date)
				VALUES ('$u', '$e', '$p', NOW() )";
				$result = @mysqli_query ($dbcon, $q);
				if ($result) {
					header ("location: register-thanks.php");
					exit();

				} else {
					echo '<h2>System Error</h2>
					<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
					echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
				}
				mysqli_close($dbcon);
				include ('footer.php');
				exit();
			} else {
				echo '<h2>Error!</h2>
				<p class="error">The following error(s) occurred:<br>';
				foreach ($errors as $msg) {
					echo " - $msg<br>\n";
				}
				echo '</p><h3>Please try again.</h3><p><br></p>';
			}
		}
		?>
		<div id="center">
			<h2>Register</h2>
			<form action="register-page.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-sm-6" for="user">Username:</label>
					<div class="col-sm-6">
						<input class="form-control" id="user" type="text" name="user" maxlength="40" value="<?php if (isset($_POST['user'])) echo $_POST['user']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-6" for="email">Email:</label>
					<div class="col-sm-6">
						<input class="form-control" id="email" type="text" name="email" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-6" for="psword1">Password:</label>
					<div class="col-sm-6">
						<input class="form-control" id="psword1" type="password" name="psword1" maxlength="20" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-6" for="psword2">Confirm Password:</label>
					<div class="col-sm-6">
						<input class="form-control" id="psword2" type="password" name="psword2" maxlength="20" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>" >
					</div>
				</div>
				<div class="form-group">
		    		<div class="col-sm-offset-5 col-sm-2">
		      			<button type="submit" class="btn btn-default" name="submit">Register</button>
		    		</div>
		  		</div>
			</form>
		</div>
		<?php include ('footer.php'); ?>
	</div>
</body>
</html>
