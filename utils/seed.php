<?php
$servername = 'localhost';
$username = 'root';
$password = '';

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$sql = 'CREATE DATABASE news_db charset=utf8;';
if (mysqli_query($conn, $sql)) {
    echo 'Database created successfully';
} else {
    echo 'Error creating database: ' . mysqli_error($conn);
}

mysqli_query($conn, 'USE news_db;');

$sql = 'CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,
category VARCHAR(30) NOT NULL
);';

if (mysqli_query($conn, $sql)) {
    echo '<br />Table Categories created successfully';
} else {
    echo '<br />Error creating table: ' . mysqli_error($conn);
}

$sql = 'CREATE TABLE news (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
category INT,
teaser TEXT NOT NULL,
news_text TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
status BOOLEAN NOT NULL DEFAULT false,
FOREIGN KEY (category) REFERENCES categories(id)
);';

if (mysqli_query($conn, $sql)) {
    echo '<br />Table News created successfully';
} else {
    echo '<br />Error creating table: ' . mysqli_error($conn);
}

$text = "Lorem ipsum dolor sit amet, ei omnis fugit postea sea, alia solet est cu,
at prima tantas consetetur sea. Ad lorem fugit quaeque sit, sale graeci electram vim ea.
Utroque constituto qui te, ferri indoctum posidonium at vim. Mel stet ferri ex,
omnis volumus blandit et cum, at mei soleat intellegebat. Porro persius phaedrum
ne mea, ne veri ludus nam. Ferri aliquip vel eu, sea dolorum salutatus ei, ad
sit vide eripuit adipiscing. An liber vitae soluta pro, id definiebas complectitur usu,
sed id nonumy efficiantur.

Eam ea laudem deleniti voluptatibus, no vel periculis deseruisse. Quo no
maiestatis scribentur, vim magna iriure aliquip et. An partem nostrum scribentur
pro. Pro labore option impetus at, apeirian urbanitas ne sea. Nam nibh dolores
accumsan in, per ex libris verear interesset, nisl complectitur qui cu. Mei posse
vituperata et. Ne vel praesent petentium mnesarchum, ea erant aliquip ceteros eum,
commune vituperata per eu.";

$teaser = "Lorem ipsum dolor sit amet, ei omnis fugit postea sea, alia solet est cu,
at prima tantas consetetur sea. Ad lorem fugit quaeque sit, sale graeci electram vim ea.";

$titles = array(
  "Apply these 7 secret techniques to improve news",
  "Believing these 7 myths about news keeps you from growing",
  "Don’t waste time! 7 facts until you reach your news",
  "How 7 things will change the way you approach news",
  "News awards: 7 reasons why they don’t work & what you can do about it",
  "News doesn’t have to be hard. Read these 7 tips",
  "News is your worst enemy. 7 ways to defeat it",
  "News on a budget: 7 tips from the great depression",
  "Knowing these 7 secrets will make your news look amazing",
  "Master the art of news with these 7 tips",
  "My life, my job, my career: how 7 simple news helped me succeed",
  "Take advantage of news - read these 7 tips",
  "The next 7 things you should do for news success");

$sql = 'INSERT INTO categories (category) VALUES("Politics");';
$sql .= 'INSERT INTO categories (category) VALUES("Religion");';
$sql .= 'INSERT INTO categories (category) VALUES("Culture");';
$sql .= 'INSERT INTO categories (category) VALUES("Sport");';

for ($i = 0; $i < 20; $i += 1) {
  $sql .= "INSERT INTO news (title, category, teaser, news_text, status)
  VALUES('" . $titles[array_rand($titles, 1)] . "', " . rand(1, 4) . ",
  '$teaser', '$text', " . rand(0, 1) . ");";
}

// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Політика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("rа", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Політика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';
// $sql .= 'INSERT INTO news (title, category, teaser, news_text) VALUES("Поgтика", 4, "Політика", "Політика");';

if (mysqli_multi_query($conn, $sql)) {
    echo '<br />New records created successfully';
} else {
    echo '<br />Error: ' . $sql . '<br>' . mysqli_error($conn);
}

mysqli_close($conn);
?>
