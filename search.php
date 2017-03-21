<!doctype html>
<html>
<head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
    <div id="container">
        <?php include("header.php"); ?>
        <?php include("nav.php"); ?>
		<?php include("info-col.php"); ?>
        <div id="content">
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
                        $query = "SELECT id, title FROM post WHERE title COLLATE UTF8_GENERAL_CI LIKE '$s_query' OR CONVERT(content USING latin1) LIKE '$s_query'";
                        $result = mysqli_query($dbcon, $query);
                    }
                }
             ?>
         </div>
     <div id="loginfields">
        <form method="post" action="search.php" id="search_form">
         <p><label class="label" for="query">Enter search terms:</label></p>
         <input type="text" name="search_query" size="100" font-size="1"></input>
         <p>&nbsp;</p>
         <p><input type="submit" id="submit" name="Search" value="Search"></p>
        </form>
    </div>
         <div id="content">
             <p>&nbsp;</p>
             <br><br>
             <?php
             if(@mysqli_num_rows($result) > 0){
                 while($row = mysqli_fetch_array($result)){
                     echo '<p>ID: ' . $row['id'] . ' Title: <a href="view_post.php?id=' . $row['id'] . '"> ' . $row['title'] . '</a>';
                 }
             }
             else{
                 if($_SERVER['REQUEST_METHOD'] == "POST"){
                     echo '<p>No matches found!';
                 }
             }
             ?>
         </div>
    </div>
<?php include("footer.php"); ?>
</body>
</html>
