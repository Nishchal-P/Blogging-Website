<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      		</button>
			<a class="navbar-brand" href="index.php">WeBlog</a>
		</div>
		<div class="collapse navbar-collapse" id="header">
			<ul class="nav navbar-nav navbar-right">
				<?php
				session_start();
				if(!isset($_SESSION['user_id'])){
					echo '<li><a href="register-page.php"><span class="glyphicon glyphicon-user"></span> Sign-Up</a></li>';
					echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
				}
				else {
					echo '<li><a href="change_password.php"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li>';
					echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
				}
	            ?>
			</ul>
		</div>
	</div>
</nav>
