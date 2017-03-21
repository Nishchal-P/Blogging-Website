<!doctype html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="includes.css">
    <style type="text/css">
    p { text-align:center; }
    </style>
</head>
<body>
    <div id="container">
        <?php include("header.php"); ?>
        <?php include("nav.php"); ?>
        <?php include("info-col.php"); ?>
        <div id="content">
            <?php
            if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2))
            {
                header("Location: login.php");
                exit();
            }
            echo '<h2>Welcome to the administrator page ';
            if (isset($_SESSION['username'])){
                echo "{$_SESSION['username']}";
            }
            echo '</h2>';
            ?>
            <div id="midcol">
                <h3>Users:-</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>e-mail ID</th>
                        <th>Joined</th>
                        <th>Admin</th>
                    </tr>
                    <?php
                    require("mysqli_connect.php");
                    $query="SELECT username, id, join_date, email, user_level FROM users";
                    $result = mysqli_query($dbcon, $query);
                    while($row=mysqli_fetch_array($result)){
                        echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['join_date'] . '</td>
                            <td>' . ($row['user_level']==2? 'Yes':'No') . '</td>
                        </tr>';
                    }
                     ?>
                </table>
            </div>
        </div>
    </div>
        <div id="footer">
            <?php include("footer.php"); ?>
        </div>
</body>
</html>
