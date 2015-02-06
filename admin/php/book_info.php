<?php 

  function generateBookInfo($book) {
    $to_return = '<div class="book-info book-title">'.$book['title'].'</div>'
        .'<div class="book-info book-author">Author: '.$book['author'].'</div>'
        .'<div class="book-info book-price">Price: $'.$book['price'].'</div>';
    return $to_return;
  }

?>