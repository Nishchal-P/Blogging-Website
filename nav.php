<div id="nav">
    <ul>
        <li><a href="post.php" title="New Post">New Post</a></li>
        <li><a href="search.php" title="Search">Search</a></li>
        <li><a href="index.php" title="Return to Home Page">Home Page</a></li>
        <?php
        if(isset($_SESSION['user_id'])){
            echo '<li><a href="members-page.php" title="Member\'s Page">My Page</a></li>';
        }
        if(isset($_SESSION['user_level']) && ($_SESSION['user_level'] == 2)){
            echo '<li><a href="admin-page.php" title="Admin Page">Admin Page</a></li>';
        }
        ?>
    </ul>
</div>
