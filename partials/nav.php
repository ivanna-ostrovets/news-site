<?php $url = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")); ?>

<nav>
  <a href="index.php" class="
    <?php if ($_SERVER['REQUEST_URI'] == '/' || 
      $_SERVER['REQUEST_URI'] == '/index.php' ||
      ($url == '/index.php' && isset($_GET['publicated']) && $_GET['publicated'] == 1)): ?>
        active
    <?php endif; ?>
  ">News</a>
  <a href="index.php?publicated=0" class="
    <?php if ($url == '/index.php' && isset($_GET['publicated']) && $_GET['publicated'] == 0): ?>
      active
    <?php endif; ?>
  ">Unpublicated news</a>
  <a href="create.php" class="
    <?php if ($_SERVER['REQUEST_URI'] == '/create.php'): ?>
      active
    <?php endif; ?>
  ">Create news</a>
</nav>
