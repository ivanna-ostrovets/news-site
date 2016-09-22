<?php
  require 'db/connect.php';

  $sql = "DELETE FROM news WHERE id={$_GET['id']}";

  if (mysqli_query($conn, $sql)) {
    header('Location: index.php');
  } else {
    die('Error deleting news: ' . mysqli_error($conn));
  }

  mysqli_close($conn);
?>
