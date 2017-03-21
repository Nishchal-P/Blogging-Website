<h2>Login</h2>
<form action="login.php" method="post">
	<p><label class="label" for="email">Email Address:</label>
	<input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>
	<br>
	<p><label class="label" for="password">Password:</label>
	<input id="password" type="password" name="password" size="30" maxlength="20" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" ><span>&nbsp;Between 8 and 20 characters.</span></p>
	<p>&nbsp;</p><p><input id="submit" type="submit" name="submit" value="Login"></p>
</form><br>
