<?php

class Book {

  public $id = -1;
  public $title = '';
  public $first_name = '';
  public $last_name = '';
  public $price = 0.0;
  public $publisher = '';
  public $isbn = 0;
  public $description = '';
  public $cover = NULL;

  function __construct($data) {
    foreach ($data as $key => $value) {
      $this->$key = $value;
    }
  }

  public static function get_book($isbn) {
    $db = open_connection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT title, first_name, last_name, price,
        publisher.name as publisher, isbn
      FROM book, author, publisher
      WHERE book.author_id=author.id
        AND book.publisher_id=publisher.id
        AND isbn=:isbn;"
    );
    $stmt->execute(['isbn' => $isbn]);
    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $output = new Book($result);

      return $output;
    }
  }

  /**
   * Generate content for a cell in tables holding book information.
   * For use in Cart, Order-confirmation, etc.
   *
   * @param boolean $show_publisher Whether or not to show publisher info
   * @param boolean $show_isbn Whether or not to show isbn
   */
  public function generateBookInfo($show_publisher = false, $showISBN = false) {

    $to_return = $this->generateBookInfoLine('Title', $this->title)
    . $this->generateBookInfoLine('Author', $this->first_name . ' ' . $this->last_name)
    . $this->generateBookInfoLine('Price', "$" . $this->price);

    if ($show_publisher) {
      $to_return .= $this->generateBookInfoLine('Publisher', $this->publisher);
    }

    if ($showISBN) {
      $to_return .= $this->generateBookInfoLine('ISBN', $this->isbn);
    }

    return $to_return;
  }

  /**
   * Generate line in book info content
   *
   * @param string $label
   *          Label (one word only)
   * @param string $content
   *          Content
   */
  private static function generateBookInfoLine($label, $content) {
    $lower_case = strtolower($label);
    return '<div class="book-info book-' . $lower_case . '">
          <label class="book-label">' . $label . '</label>' . $content . '</div>';
  }

  /**
   * Generate content for a book with cover, used on the main page
   */
  public function generateBookView() {
    $to_return = '<div class="book-view"><a class="no-decoration" href="book.php?isbn=' . $this->isbn . '">
          <img src="' . $this->get_cover($this->cover) . '" class="book-cover" /><div class="book-info-box">'
            . $this->generateBookInfoLine('Title', $this->title)
            . $this->generateBookInfoLine('Author', $this->first_name . ' ' . $this->last_name)
            . '</div>
             </a></div>';
    return $to_return;
  }

  public function get_cover($cover) {
    if ($cover) {
      return 'admin/images/covers/' . $cover;
    } else {
      //include_once 'constants.php';
      //$images = glob($GLOBALS['locations']['random_covers'] . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
      $images = scandir('admin/images/covers/random/');
      do {
        $the_image = $images[array_rand($images)];
      } while (substr($the_image, 0, 1) === '.');
      return 'admin/images/covers/random/' . $the_image;
    }
  }
}

?>