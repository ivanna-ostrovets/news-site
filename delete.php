<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'news_db';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  $sql = "DELETE FROM news WHERE id={$_GET['id']}";

  if (mysqli_query($conn, $sql)) {
    header('Location: index.php');
  } else {
    die('Error deleting news: ' . mysqli_error($conn));
  }

  mysqli_close($conn);
?>
