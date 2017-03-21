<!doctype html>
<html>
<head>
	<title>The Login page</title>
	<link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
	<div id="container">
		<?php include("login-header.php"); ?>
		<?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
		<div id="content">
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
			<div id="loginfields">
				<?php include ('login_page.inc.php'); ?>
			</div><br>
			<?php include ('footer.php'); ?>
		</div>
	</div>
</body>
</html>
