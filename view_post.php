<!doctype html>
<html>
<head>
    <title>View Post</title>
    <link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
    <div id="container">
        <?php include("header.php"); ?>
        <?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
        <div id="content">
            <?php
                if($_GET['id'] != NULL){
                    require("mysqli_connect.php");
                    $pid=$_GET['id'];
                    $query = "SELECT title, content FROM post WHERE id=$pid";
                    $result = mysqli_query($dbcon, $query);
                    if(mysqli_num_rows($result) == 0){
                        echo 'The post you are looking for does not exist.';
                        echo '<p>Possible reasons for this:-';
                        echo '<br>1. A post with this ID never existed.';
                        echo '<br>2. The post was taken down by an admin.';
                    }
                    $row = mysqli_fetch_array($result);
                }
                else{
                    header("Location: search.php");
                    exit();
                }
            ?>
            <p style="font-size:30px"><label for="title">
                <?php echo $row['title'] ?>
            </label></p>
            <p><label for="content">
                <?php echo $row['content']?>
            </label></p>
            <br><br>
            <p style="font-size:20px"><label for="comments">Comments:-</label></p>
            <?php
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
                while($rows = mysqli_fetch_array($result)){
                    echo '<p> ' . $rows['username'] . ': ' . $rows['content'];
                    echo ' ('. $rows['time_posted'] . ')</p>';
                }
                if(isset($_SESSION['user_id'])){
                    echo '
                    <br>
                    <p><label for="comment">Comment:</label>
                        <form method="post" action="view_post.php?id=' . $pid . '" id="comment_form">
                            <input type="text" name="comment_content" size="100"></input>
                            <input type="submit" id="submit" name="Comment" value="Comment">
                        </form>
                    ';
                }
            ?>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
