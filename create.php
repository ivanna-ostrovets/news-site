<?php
  require 'db/connect.php';

  $sql = 'SELECT * FROM categories';
  $categories = mysqli_query($conn, $sql);

  if (!$categories) {
    die('Error creating news: ' . mysqli_error($conn));
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Create news</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/form.css">
  </head>
  <body>
    <?php include "partials/nav.php"; ?>

    <main class="main">
      <form action="create_action.php" method="post" id="newform">
        <div class="form-group">
          <label>Title</label>
          <input class="full-width" type="text" name="title">
        </div>

        <div class="form-group">
          <label>Category</label>
          <select name="category" form="newform">
            <?php while ($category = mysqli_fetch_assoc($categories)): ?>
              <option value="<?= $category["id"] ?>">
                <?= $category["category"] ?>
              </option>;
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Teaser</label>
          <textarea name="teaser"></textarea>
        </div>

        <div class="form-group">
          <label>Text</label>
          <textarea name="news_text"></textarea>
        </div>

        <div class="form-group">
          <label>Publicate</label>
          <input type="checkbox" name="status"/>
        </div>

        <a href="index.php" class="button">Cancel</a>

        <input type="submit" value="Create" class="button">

      </form>
    </main>
  </body>
</html>

<?php mysqli_close($conn); ?>
