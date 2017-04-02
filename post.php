<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Post</title>
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
            if(!isset($_SESSION['user_id'])){
                echo 'Only registered users can create new posts. <a href="login.php">Login</a> to continue';
                exit();
            }
            else{
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    require("mysqli_connect.php");
                    if(!empty($_POST['title'])){
                        $id = $_SESSION['user_id'];
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $query = "INSERT INTO post (user_id, title, content) VALUES ($id, '$title', '$content')";
                        $result = mysqli_query($dbcon, $query);
                        if($result){
                            echo 'Success!';
                        }
                    }
                }
            }
            ?>
        </div>
        <form class="form-horizontal" method="post" action="post.php" id="post_form">
            <div class="form-group">
                <label class="control-label col-sm-1" for="title">Title:</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="title" font-size="1"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="content">Content:</label>
                <div class="col-sm-6">
                    <textarea class="form-control" form="post_form" name="content" rows="20" cols="90"> </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <input type="submit" class="btn btn-default" id="submit" name="post" value="Post">
                </div>
            </div>
        </form>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
