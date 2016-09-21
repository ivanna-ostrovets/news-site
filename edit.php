<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'news_db';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  $sql = 'SELECT * FROM categories';
  $categories = mysqli_query($conn, $sql);

  if (!$categories) {
    die('Error editing news: ' . mysqli_error($conn));
  }

  $sql = "SELECT * FROM news WHERE news.id={$_GET['id']}";
  $news_query = mysqli_query($conn, $sql);

  if (!$news_query) {
    die('Error editing news: ' . mysqli_error($conn));
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit news</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/form.css">
  </head>
  <body>
    <?php include "partials/nav.php"; ?>

    <main class="main">
      <?php while($news = mysqli_fetch_assoc($news_query)): ?>
        <form action="edit_action.php?id=<?= $news['id'] ?>" method="post" id="newform">
          <div class="form-group">
            <label>Title</label>
            <input class="full-width" type="text" name="title" value="<?= $news['title'] ?>">
          </div>

          <div class="form-group">
            <label>Category</label>
            <select name="category" form="newform">
              <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                <option
                  <?php if ($news['category'] == $category['id']): ?>
                    selected
                  <?php endif; ?>
                  value="<?= $category['id'] ?>">
                  <?= $category['category'] ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Teaser</label>
            <textarea name="teaser"><?= $news['teaser'] ?></textarea>
          </div>

          <div class="form-group">
            <label>Text</label>
            <textarea name="news_text"><?= $news['news_text'] ?></textarea>
          </div>

          <div class="form-group">
            <label>Publicate</label>
            <input type="checkbox"
              <?php if ($news['status'] == true): ?>
                checked
              <?php endif; ?>
            name="status"/>
          </div>

          <input type="submit" value="Save" class="button">
          <a href="show.php?id=<?= $news['id'] ?>" class="button">Cancel</a>
        </form>

      <?php endwhile; ?>
    </main>
  </body>
</html>

<?php mysqli_close($conn); ?>
