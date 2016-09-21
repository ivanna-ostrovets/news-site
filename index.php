<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'news_db';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
  $publicated = isset($_GET['publicated']) ? $_GET['publicated'] : 1;

  $sql = "SELECT news.*, categories.category FROM news JOIN categories ON categories.id=news.category
  WHERE news.status=$publicated ORDER BY news.created_at
  DESC LIMIT 10 OFFSET $offset";

  $result = mysqli_query($conn, $sql);

  if (!$result) {
    die('Error reading news: ' . mysqli_error($conn));
  }

  $sql = "SELECT COUNT(*) AS count FROM news WHERE status=$publicated";

  $query = mysqli_query($conn, $sql);

  if (!$query) {
    die('Error counting news: ' . mysqli_error($conn));
  }

  $numOfNews = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>News</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <?php include 'partials/nav.php'; ?>

    <main class="main">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="news">
          <div class="title"><?= $row['title'] ?></div>
          <div class="button"><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></div>
          <div class="button"><a href="delete.php?id=<?= $row['id'] ?>">Delete</a></div>
          <div class="category"><?= $row['category'] ?></div>
          <div class="date"><?= date_format(date_create($row['created_at']), 'd.m.Y') ?></div>
          <div class="teaser"><?= $row['teaser'] ?></div>
          <div class="button read"><a href="show.php?id=<?= $row['id'] ?>">Read more</a></div>
        </div>
      <?php endwhile; ?>
    </main>

    <footer class="pager">
      <?php for ($i = 0; $i < $numOfNews['count']; $i += 10): ?>
        <a href="index.php?offset=<?= $i ?>&publicated=<?= $publicated ?>" class="pages">
          <?= $i + 1 ?> - <?= $i + 10 ?>
        </a>
      <?php endfor; ?>
    </footer>
  </body>
</html>

<?php mysqli_close($conn); ?>
