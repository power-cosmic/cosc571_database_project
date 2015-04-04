<?php
/**
 * Singleton pattern for Cart.
 * This item will be assigned to $_SESSION['cart']
 * Holds an associative array where book->quantity.
 *
 * To use: call static function Cart::get_instance()
 */


class Cart {

  private $items;
  private $subtotal;

  /**
   * Get cart singleton
   * @return Cart
   */
  public static function get_instance() {
    //session_unset();

    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = new Cart();
    } else {
    }
    return $_SESSION['cart'];
  }

  private function __construct($items = null) {
    $this->items = $items? $items : [];
    $this->subtotal = 0;
  }

  /**
   * Get the item array
   */
  public function get_items() {
    return $this->items;
  }

  /**
   * Get subtotal
   */
  public function get_subtotal() {
    return $this->subtotal;
  }

  /**
   * Add an Item to the cart
   * @param String $isbn Book ISBN
   * @param number $quantity Quantity (defaults to 1)
   */
  public function add_item($isbn, $quantity = 1) {
    if (isset($this->items[$isbn])) {
      $this->increment_quantity($isbn, $quantity);
    } else {
      $item = $this->items[$isbn] = [
          'book' => Book::get_book($isbn),
          'quantity' => $quantity
      ];
      $this->subtotal += $item['book']->price * $quantity;
    }
  }

  /**
   * Increment/decrement item quantity.
   * If quantity is set to below 1, item is removed.
   * @param String $isbn Book ISBN
   * @param number $increment Amount to change
   */
  public function increment_quantity($isbn, $increment = 1) {

    $item = $this->items[$isbn];
    $this->items[$isbn]['quantity'] += $increment;
    if ($item['quantity'] <= 0) {
      $this->remove_item($isbn);
    } else {
      $this->subtotal += $item['book']->price * $increment;
    }
  }

  /**
   * Set the quantity of an item.
   * If quantity is set to less than 1, it is removed.
   * @param String $isbn Book ISBN
   * @param number $quantity Quantity
   */
  public function set_quantity($isbn, $quantity) {
    if ($quantity < 0) {
      $quantity = 0;
    }

    $item = $this->items[$isbn];

    if ($quantity == 0) {
      $this->remove_item($isbn);
    } else {
      $change = $quantity - $this->items[$isbn]['quantity'];
      $this->items[$isbn]['quantity'] = $quantity;
      $this->subtotal += $item['book']->price * $change;
    }
    return $item;
  }

  /**
   * Remove an item from the cart.
   * @param String $isbn Book ISBN
   */
  public function remove_item($isbn) {
    $item = $this->items[$isbn];
    $this->subtotal -= $item['book']->price * $item['quantity'];
    unset($this->items[$isbn]);
  }

  public function get_price($isbn) {
    $item = $this->items[$isbn];
    return $item['book']->price * $item['quantity'];
  }

  public function empty_cart() {
    $this->items = null;
    unset($this->items);
  }

  public function num_in_cart() {
    $to_return = 0;
    foreach ($this->items as $item) {
      $to_return += $item['quantity'];
    }
    return $to_return;
  }
}

?>