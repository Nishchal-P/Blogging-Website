<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Post</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
    <script type="text/javascript">
    function removePost(remove_id){
        var val=remove_id;
        self.location='remove.php?post=' + val + '&user=';
    }
    </script>
    <?php include("header.php"); ?>
	<?php include("nav.php"); ?>
    <div id="container">
        <div id="content">
            <?php
                if($_GET['id'] != NULL){
                    require("mysqli_connect.php");
                    $pid=$_GET['id'];
                    $query = "SELECT title, user_id, content FROM post WHERE id=$pid";
                    $result = mysqli_query($dbcon, $query);
                    if(mysqli_num_rows($result) == 0){
                        echo 'The post you are looking for does not exist.';
                        echo '<p>Possible reasons for this:-';
                        echo '<br>1. A post with this ID never existed.';
                        echo '<br>2. The post was taken down by an admin.';
                    }
                    $row = mysqli_fetch_array($result);
                    $user_id = $row['user_id'];
                    $query ="SELECT username FROM users WHERE id=$user_id";
                    $result = mysqli_query($dbcon, $query);
                    $poster = mysqli_fetch_array($result);
                }
                else{
                    header("Location: search.php");
                    exit();
                }
            ?>
            <p style="font-size: 30px"><b><?php echo $row['title'] ?></b></p>
            <p> Author: <?php echo $poster['username']; ?> </p>
            <p style="font-size: 20px"><?php echo $row['content']?></p>
            <br><br>
            <?php
            if(mysqli_num_rows($result) != 0){
                echo '<p style="font-size:20px"><label for="comments">Comments:-</label></p>';
                if(isset($_SESSION['user_id'])){
                    $uid = $_SESSION['user_id'];
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $content = $_POST['comment_content'];
                        $q = "INSERT INTO comment (post_id, user_id, content) VALUES ($pid, $uid, '$content')";
                        $result = mysqli_query($dbcon, $q);
                    }
                }
                $query = "SELECT content, username, time_posted FROM comment, users WHERE post_id=$pid AND user_id=users.id ORDER BY time_posted ASC";
                $result = mysqli_query($dbcon, $query);
                if(@mysqli_num_rows($result) == 0){
                    echo'No comments yet <br><br>';
                }
                while($rows = mysqli_fetch_array($result)){
                    echo '<p><b> ' . $rows['username'] . '</b> : ' . $rows['content'];
                    echo ' <text style="color:grey">('. $rows['time_posted'] . ')</text></p>';
                }
                if(isset($_SESSION['user_id'])){
                    echo '
                    <br>
                    <form class="form-inline" method="post" action="view_post.php?id=' . $pid . '" id="comment_form">
                        <div class="form-group">
                            <input class="form-control" type="text" name="comment_content" placeholder="Add a comment..." size="100"></input>
                            <input class="btn btn-default" type="submit" id="submit" name="Comment" value="Comment"></input>
                        </div>
                    </form>
                    ';
                }
                else{
                    echo '<br><a href="login.php" style="color: red"><u>Sign in</u></a> to comment on this post.';
                }
                if(isset($_SESSION['user_level']) and $_SESSION['user_level'] == 2){
                    echo '<br><br>';
                    echo '<button class="btn btn-default" onclick="removePost(' . $pid . ')">Remove Post</button>';
                }
            }
            ?>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
