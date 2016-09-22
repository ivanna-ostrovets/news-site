<?php
  require 'db/connect.php';

  $status = $_POST['status'] == 'on' ? 1 : 0;

  $sql = "INSERT INTO news (title, category, teaser, news_text, status)
  VALUES('{$_POST['title']}', {$_POST['category']}, '{$_POST['teaser']}',
  '{$_POST['news_text']}', $status)";

  if (mysqli_query($conn, $sql)) {
    header('Location: index.php');
  } else {
    die('Error creating news: ' . mysqli_error($conn));
  }

  mysqli_close($conn);
?>
