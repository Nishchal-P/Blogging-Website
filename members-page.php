<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Page</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("header.php"); ?>
	<?php include("nav.php"); ?>
    <div id="container">
        <div id="content">
            <?php
            if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] == 0))
            {
                header("Location: login.php");
                exit();
            }
            echo '<h2>Welcome to your page ';
            if (isset($_SESSION['username'])){
                echo "{$_SESSION['username']}!";
            }
            echo '</h2>';
            ?>
            <br><br>
            <h4>Your Posts:-</h4>
            <?php
            $uid = $_SESSION['user_id'];
            require("mysqli_connect.php");
            $q1 = "SELECT id, title, content, DATE_FORMAT(posted,'%M %e ,%Y') AS date_posted FROM post WHERE user_id=$uid ORDER BY id DESC";
            $res1 = mysqli_query($dbcon, $q1);
            if(@mysqli_num_rows($res1) == 0){
                echo 'You haven\'t posted anything yet.';
            }
            else{
                while($row1 = mysqli_fetch_array($res1)){
                    echo '<div class="col-sm-10">
                        <a href="view_post.php?id=' . $row1['id'] . '" id="well-anchor">
                            <div class="well">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <text style="font-size: 150%">'. $row1['title']. '</text>
                                        </div>
                                        <p>'. substr($row1['content'], 0, 50) . (strlen($row1['content'])>50? '...' : ' ') . '</p>
                                        <ul class="list-inline list-unstyled">
                                        <li><span><i class="glyphicon glyphicon-calendar"></i> '. $row1['date_posted']. ' </span></li>
                                        <li>|</li><li> </li>';
                                        $pid = $row1['id'];
                                        $q2 = "SELECT COUNT(id) AS count_id FROM comment WHERE post_id=$pid";
                                        $res2 = mysqli_query($dbcon, $q2);
                                        $row2 = mysqli_fetch_array($res2);
                                        echo '<span><i class="glyphicon glyphicon-comment"></i> ' . $row2["count_id"] . ' comment' . ($row2["count_id"]==1? '': 's') . '</span>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            }
            ?>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
