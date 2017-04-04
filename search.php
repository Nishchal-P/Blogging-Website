<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search</title>
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
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                require("mysqli_connect.php");
                if(!empty($_POST['search_query'])){
                    $s_query="";
                    $terms = explode(" ", $_POST['search_query']);
                    foreach ($terms as &$word) {
                        $s_query = "$s_query%$word";
                    }
                    $s_query = "$s_query%";
                    $query = "SELECT id, title, content, user_id, DATE_FORMAT(posted,'%M %e ,%Y') AS date_posted FROM post WHERE title COLLATE UTF8_GENERAL_CI LIKE '$s_query' OR CONVERT(content USING latin1) LIKE '$s_query' ORDER BY id DESC";
                    $result = mysqli_query($dbcon, $query);
                }
            }
        ?>
        <br>
        <form method="post" action="search.php" id="search_form">
            <div class="input-group col-sm-offset-3 col-sm-6">
                <input type="text" class="form-control" name="search_query" placeholder="Search"></input>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <br><br>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            echo "<h2>Search results:-</h2><br>";
            if(@mysqli_num_rows($result) == 0){
    			echo '<p>No matches found</p>';
    		}
    		else{
    			while($rows = mysqli_fetch_array($result)){
    				$uid = $rows['user_id'];
    				$q2 = "SELECT username FROM users WHERE id=$uid";
    				$res2 = mysqli_query($dbcon, $q2);
    				$row2 = mysqli_fetch_array($res2);
    				echo '<div class="col-sm-10">
    					<a href="view_post.php?id=' . $rows['id'] . '" id="well-anchor">
    					<div class="well">
    						<div class="media">
    							<div class="media-body">
    								<div class="media-heading">
    									<text style="font-size: 150%">'. $rows['title']. '</text> - '. $row2['username']. '
    								</div>
    								<p>'. substr($rows['content'], 0, 50) . (strlen($rows['content'])>50? '...' : ' ') . '</p>
    								<ul class="list-inline list-unstyled">
    								<li><span><i class="glyphicon glyphicon-calendar"></i> '. $rows['date_posted']. ' </span></li>
    								<li>|</li><li> </li>';
    								$pid = $rows['id'];
    								$q3 = "SELECT COUNT(id) AS count_id FROM comment WHERE post_id=$pid";
    								$res3 = mysqli_query($dbcon, $q3);
    								$row3 = mysqli_fetch_array($res3);
    								echo '<span><i class="glyphicon glyphicon-comment"></i> ' . $row3["count_id"] . ' comment' . ($row3["count_id"]==1? '': 's') . '</span>
    								</ul>
    							</div>
    						</div>
    					</div>
    					</a>
    				</div>';
    			}
    		}
        }
        ?>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
