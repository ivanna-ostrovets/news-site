<?php
  require 'db/connect.php';

  $id = $_GET["id"];
  $status = $_POST['status'] == 'on' ? 1 : 0;

  $sql = "UPDATE news
  SET title='{$_POST['title']}', category={$_POST['category']},
  teaser='{$_POST['teaser']}', news_text='{$_POST['news_text']}', status=$status
  WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    header("Location: show.php?id=$id");
  } else {
    die('Error editing news: ' . mysqli_error($conn));
  }

  mysqli_close($conn);
?>
