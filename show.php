<?php
  require 'db/connect.php';

  $sql = "SELECT news.*, categories.category FROM news JOIN categories
  ON categories.id=news.category WHERE news.id={$_GET['id']}";

  $news_query = mysqli_query($conn, $sql);

  if (!$news_query) {
    die('Error reading news: ' . mysqli_error($conn));
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Read news</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/show.css">
  </head>
  <body>
    <?php include 'partials/nav.php'; ?>

    <main class="main">
      <?php while($news = mysqli_fetch_assoc($news_query)): ?>
        <div>
          <h1 class="title-show"><?= $news['title'] ?></h1>
          <div>
            <div class="date"><?= date_format(date_create($news['created_at']), 'd.m.Y') ?></div>
            <div class="category"><?= $news['category'] ?></div>
          </div>
          <div class="text-show"><?= $news['news_text'] ?></div>
          <a class="button" href="edit.php?id=<?= $news['id'] ?>">Edit</a>
          <a class="button" href="delete.php?id=<?= $news['id'] ?>">Delete</a>
          <a class="button" href="index.php">Back</a>
        </div>
      <?php endwhile; ?>
    </main>
  </body>
</html>

<?php mysqli_close($conn); ?>
