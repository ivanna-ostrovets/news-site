<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_query($conn, "DROP DATABASE news_db")) {
    echo "Db deleted!";
} else {
    echo "Error deleting: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
