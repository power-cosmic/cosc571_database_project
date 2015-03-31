<?php
require_once '../admin/php/connection.php';
require_once '../admin/php/constants.php';
require_once '../admin/php/login.php';

session_start();

$login = Login::get_instance();
if ($login->get_user_type() == $user_status['admin']) {
  
  try {
    $db = open_connection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT genre, count(*) AS count
      FROM (
        SELECT genre.name AS genre
        FROM book_genre, genre
        WHERE genre.id = book_genre.genre_id
      ) AS T
      GROUP BY genre
      ORDER BY genre DESC;";
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    $info = [];
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($info, [
        'genre' => $result['genre'],
        'count' => intval($result['count'])
      ]);
    }
    echo json_encode([
       'status' => 'success',
       'info' => $info
    ]);
  } catch(PDOException $e) {
    print_r($e);
  }

} else {
  echo json_encode([
    'status' => 'fail',
    'message' => 'Access denied'
  ]);
}

?>