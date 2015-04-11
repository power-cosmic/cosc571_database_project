<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/connection.php';

if ($_POST) {
  $db = open_connection();
  $sql = "SELECT title FROM book WHERE title='" . $_POST['title'] . "';";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll();
  if (count($rows) > 0) {
    echo 'exists!!!';
  } else {
    $sql = "SELECT id FROM publisher WHERE name='" . $_POST['publisher'] . "';";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $publisher_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    
    if (!$publisher_id) {
      die('cannot enter without valid publisher!');
    }
    $name = explode(',', $_POST['author']);
    $sql = "SELECT id FROM author WHERE last_name='" . trim($name[0]) . "' AND first_name='" . trim($name[1]) . "';";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $author_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    echo $sql;
    if (!$author_id) {
      $sql = "INSERT INTO author (last_name, first_name) VALUES ('" . trim($name[0]) . "', '" . trim($name[1]) . "');";
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $author_id = $db->lastInsertId();
    }
    echo $author_id;
    $genres = explode(',', $_POST['genre']);
    $sql = "SELECT id FROM genre WHERE name='" . trim($genres[0]) . "'";
    switch(true) {
      case $genres[2]:
        $sql .= " OR name='" . trim($genres[2]) . "'";
      case $genres[1]:
        $sql .= " OR name='" . trim($genres[1]) . "'";
      default:
        $sql .= ";";
    }
    echo $sql;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    while($genre = $stmt->fetch(PDO::FETCH_ASSOC)['id']) {
      echo "genre: $genre<br />\n";
    }
  }
}
?>
<!doctype html>
<html>
<body>
  <form action="<?=$_SESSION['PHP_SELF']?>" method="post">
    Book Title: <input name="title" type="text"><br /> Author: <input
      name="author" placeholder="last name, first name" type="text"
    /><br /> Genre (up to 3): <input name="genre"
      placeholder="genre1, genre2, genre3" type="text"
    /><br /> Publisher: <input name="publisher"><br /> <input
      type="submit"
    >
  </form>
</body>
</html>