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
  
  /**
   * Get cart singleton
   * @return Cart
   */
  public static function get_instance() {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = new Cart();
    }
    return $_SESSION['cart'];
  }
  
  private function __construct($items = null) {
    $this->items = $items? $items : [];
  }
  
  /**
   * Get the item array
   */
  public function get_items() {
    return $this->items;
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
      $this->items[$isbn] = $quantity;
    }
  }
  
  /**
   * Increment/decrement item quantity.
   * If quantity is set to below 1, item is removed.
   * @param String $isbn Book ISBN
   * @param number $increment Amount to change
   */
  public function increment_quantity($isbn, $increment = 1) {
    echo 'incrementing';
    $this->items[$isbn] += $increment;
    if ($this->items[$isbn] <= 0) {
      $this->remove_item($isbn);
    }
  }
  
  /**
   * Set the quantity of an item.
   * If quantity is set to less than 1, it is removed.
   * @param String $isbn Book ISBN
   * @param number $quantity Quantity
   */
  public function set_quantity($isbn, $quantity) {
    $this->items[$isbn] = $quantity;

    if ($this->items[$isbn] <= 0) {
      $this->remove_item($isbn);
    }
  }
  
  /**
   * Remove an item from the cart.
   * @param String $isbn Book ISBN
   */
  public function remove_item($isbn) {
    unset($this->items[$isbn]);
  }
  
}

?>