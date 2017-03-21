<!doctype html>
<html>
<head>
	<title>Change password</title>
	<link rel="stylesheet" type="text/css" href="includes.css">
	<style type="text/css">
	p.error {
		color: red;
		font-size: 105%;
		font-weight: bold;
		text-align: center;
	}
	</style>
</head>
<body>
	<div id="container">
		<?php include("header.php"); ?>
		<?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
		<div id="content">
			<p><?php
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
			<form action="register-password.php" method="post">
				<p><label class="label" for="email">Email Address:</label><input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>
				<p><label class="label" for="psword">Current Password:</label><input id="psword" type="password" name="psword" size="30" maxlength="20" value="<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>"></p>
				<p><label class="label" for="psword1">New Password:</label><input id="psword1" type="password" name="psword1" size="30" maxlength="20" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>"></p>
				<p><label class="label" for="psword2">Confirm New Password:</label><input id="psword2" type="password" name="psword2" size="30" maxlength="20" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>"></p>
				<p><input id="submit"type="submit" name="submit" value="Change Password"></p>
			</form>
			<?php include ('footer.php'); ?></p>
		</div>
	</div>
</body>
</html>
