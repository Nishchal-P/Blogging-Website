<!doctype html>
<html>
<head>
	<title>Register page</title>
	<link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
	<div id="container">
		<?php include("register-header.php"); ?>
		<?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
		<div id="content">
			<p>
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
				<h2>Register</h2>
				<form action="register-page.php" method="post">
					<p>
						<label class="label" for="user">Username:</label>
						<input id="user" type="text" name="user" size="30" maxlength="40" value="<?php if (isset($_POST['user'])) echo $_POST['user']; ?>">
					</p>
					<p>
						<label class="label" for="email">Email Address:</label>
						<input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
					</p>
					<p>
						<label class="label" for="psword1">Password:</label>
						<input id="psword1" type="password" name="psword1" size="30" maxlength="20" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >&nbsp;(Between 8 and 20 characters)
					</p>
					<p>
						<label class="label" for="psword2">Confirm Password:</label>
						<input id="psword2" type="password" name="psword2" size="30" maxlength="20" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>" >
					</p>
					<p><input id="submit" type="submit" name="submit" value="Register"></p>
				</form>
				<?php include ('footer.php'); ?>
			</p>
		</div>
	</div>
</body>
</html>
