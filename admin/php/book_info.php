<?php 

  /**
   * Generate content for a cell in tables holding book information.
   * For use in Cart, Order-confirmation, etc.
   * 
   * @param array   $book Book information (title, author, etc)
   * @param boolean $show_publisher Whether or not to show publisher info
   * @param boolean $show_isbn Whether or not to show isbn
   */
  function generateBookInfo($book, $show_publisher = false, $showISBN = false) {
    $to_return = generateBookInfoLine('Title', $book['title'])
        . generateBookInfoLine('Author', $book['author'])
        . generateBookInfoLine('Price', "$" . $book['price']);
    
    if ($show_publisher) {
      $to_return .= generateBookInfoLine('Publisher', $book['publisher']);
    }
    
    if ($showISBN) {
      $to_return .= generateBookInfoLine('ISBN', $book['isbn']);
    }
    
    return $to_return;
  }
  
  /**
   * Generate line in book info content
   * @param string $label    Label (one word only)
   * @param string $content  Content
   */
  function generateBookInfoLine($label, $content) {
    $lower_case = strtolower($label);
    return '<div class="book-info book-' . $lower_case . '">
        <label class="book-label">' . $label . '</label>' 
        . $content
        . '</div>'; 
  }

?>