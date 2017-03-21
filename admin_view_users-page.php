<!doctype html>
<html>
<head>
	<title>View users page</title>
	<link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
	<div id="container">
		<?php include("header.php"); ?>
		<?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
		<div id="content">
			<h2>These are the registered users</h2>
			<p>
				<?php
				require ('mysqli_connect.php');
				$query = "SELECT username, user_level, DATE_FORMAT(join_date, '%d-%M-%Y') AS joined FROM users ORDER BY joined ASC";
				$result = @mysqli_query ($dbcon, $query);
				if ($result) {
					// Edit
					echo '<table>
					<tr>
						<td align="left"><b>Name</b></td>
						<td align="left"><b>Date joined</b>
						<td align="left"><b>User Level</b>
						</td>
					</tr>';
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						echo '<tr><td align="left">' . $row['username']
						 . '</td><td align="left">' . $row['joined']
						 . '</td><td align="left">' . $row['user_level'] . '</td></tr>';
					}
					echo '</table>';
					mysqli_free_result ($result);
				}
				else {
					echo '<p>' . mysqli_error($dbcon) . '<br><br />Query: ' . $query . '</p>';
				}
				mysqli_close($dbcon);
				?>
			</p>
		</div>
		<?php include("footer.php"); ?>
	</div>
</body>
</html>
