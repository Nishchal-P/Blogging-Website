<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<?php include("header.php"); ?>
	<?php include("nav.php"); ?>
	<div id="container">
		<div id="center">
			<?php
			if(!isset($_SESSION['user_id'])){
				header("Location: login.php");
				exit();
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				require ('./mysqli_connect.php');
				$errors = array();
				if (empty($_POST['email'])) {
					$errors[] = 'You forgot to enter your email address.';
				}
				else {
					$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
				}
				if (empty($_POST['psword'])) {
					$errors[] = 'You forgot to enter your current password.';
				}
				else {
					$p = mysqli_real_escape_string($dbcon, trim($_POST['psword']));
				}
				if (!empty($_POST['psword1'])) {
					if ($_POST['psword1'] != $_POST['psword2']) {
						$errors[] = 'Your new password did not match the confirmed password.';
					}
					else {
						$np = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
					}
				}
				else {
					$errors[] = 'You forgot to enter your new password.';
				}
				if (empty($errors)) {
					$q = "SELECT id FROM users WHERE (email='$e' AND password='$p')";
					$result = @mysqli_query($dbcon, $q);
					$num = @mysqli_num_rows($result);
					if ($num == 1) {
						$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$q = "UPDATE users SET password='$np' WHERE id=$row[0]";
						$result = @mysqli_query($dbcon, $q);
						if (mysqli_affected_rows($dbcon) == 1) {
							echo '<h2>Thank you!</h2>
							<h3>Your password has been updated.</h3>';
						}
						else {
							echo '<h2>System Error</h2>
							<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
							echo '<p>' . mysqli_error($dbcon) . '<br /><br />Query: ' . $q . '</p>';
						}
						mysqli_close($dbcon);
						include ('footer.php');
						exit();
					}
					else {
						echo '<h2>Error!</h2>
						<p class="error">The email address and password do not match those on file.</p>';
					}
				}
				else {
					echo '<h2>Error!</h2>
					<p class="error">The following error(s) occurred:<br />';
					foreach ($errors as $msg) {
						echo " - $msg<br />\n";
					}
					echo '</p><p class="error">Please try again.</p><p><br /></p>';
				}
			mysqli_close($dbcon);
		}
			?>
			<h2>Change Your Password</h2>
			<form action="register-password.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-sm-6" for="email">Email Address:</label>
					<div class="col-sm-6">
						<input class="form-control" id="email" type="text" name="email" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-6" for="psword">Current Password:</label>
					<div class="col-sm-6">
						<input class="form-control" id="psword" type="password" name="psword" maxlength="20" value="<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-6" for="psword1">New Password:</label>
					<div class="col-sm-6">
						<input class="form-control" id="psword1" type="password" name="psword1" maxlength="20" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-6" for="psword2">Confirm New Password:</label>
					<div class="col-sm-6">
						<input class="form-control" id="psword2" type="password" name="psword2" maxlength="20" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>">
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-default" id="submit" type="submit" name="submit">Change Password</button>
				</div>
			</form>
		</div>
		<?php include ('footer.php'); ?>
	</div>
</body>
</html>
