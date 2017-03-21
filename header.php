<div id="header">
<h1>WeBlog</h1>
<div id="reg-navigation">
		<ul>
			<?php
			session_start();
			if(!isset($_SESSION['user_id'])){
				echo '<li><a href="login.php">Login</a></li>';
				echo '<li><a href="register-page.php">Register</a></li>';
			}
			else {
				echo '<li><a href="logout.php">Logout</a></li>';
				echo '<li><a href="change_password.php">Change Password</a></li>';
			}
            ?>
			<li><a href="index.php">Home</a></li>
		</ul>
	</div>
</div>
