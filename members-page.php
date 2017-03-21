<!doctype html>
<html>
<head>
    <title>Members page</title>
    <link rel="stylesheet" type="text/css" href="includes.css">
    <style type="text/css">

    #mid-right-col {
        text-align:center;
        margin:auto;
    }

    #midcol h3 {
        font-size:130%;
        margin-top:0;
        margin-bottom:0;
    }

    </style>
</head>
<body>
    <div id="container">
        <?php include("header.php"); ?>
        <?php include("nav.php"); ?>
        <?php include("info-col.php"); ?>
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
            <div id="midcol">
                <div id="mid-left-col">
                    <h3>Your Posts</h3>
                    <br>
                    <?php
                        require("mysqli_connect.php");
                        $uid = $_SESSION['user_id'];
                        $query = "SELECT title, id FROM post WHERE user_id=$uid";
                        $result = mysqli_query($dbcon, $query);
                        if(@mysqli_num_rows($result) == 0){
                            echo 'You have not posted anything yet.';
                        }
                        while($row = mysqli_fetch_array($result)){
                            echo '<a href="view_post.php?id=' . $row['id'] . '">' . $row['title'] . '</a><br>';
                        }
                    ?>
                </div>
                <div id="mid-right-col">
                    <h3></h3>
                    <p><b></b></p>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
