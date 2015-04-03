<?php
require_once '../admin/php/connection.php';

$index = isset($_GET['index'])? $_GET['index'] : 0;
$count = isset($_GET['count'])? $_GET['count'] : 20;

$db = open_connection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = 'SELECT title, COUNT(review.book_isbn) AS reviews
  FROM book
  LEFT JOIN review
  ON book.isbn = review.book_isbn
  GROUP BY book.isbn
  LIMIT :index, :count';

$stmt = $db->prepare($query);
$stmt->execute([
    'index' => $index,
    'count' => $count
]);

$books = [];
while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
  array_push($books, [
  'title' => $result['title'],
  'reviews' => intval($result['reviews'])
  ]);
}

$query = 'SELECT count(*) AS count FROM book';

$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $result['count'];

echo json_encode([
    'books' => $books,
    'total' => $total
]);

?>