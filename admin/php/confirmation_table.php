<?php
include_once 'book_info.php';
include_once 'connection.php';

function generate_confirmation_table($title, $user, $books, $confirmation = null) {
  $card_types = [
      'MasterCard',
      'VISA'
  ];

  $login = Login::get_instance();
  $cart = Cart::get_instance();

  $current_address = $login->get_primary_address();
  $primary_card = $login->get_primary_card();

  $user = [
      'username' => $login->get_username(),
      'first_name' => $login->get_first_name(),
      'last_name' => $login->get_last_name(),
      'address' => $current_address['street_address'],
      'city' => $current_address['city'],
      'state' => $current_address['state'],
      'zip' => $current_address['zip'],
      'card_type' => $primary_card['issuer'],
      'card_number' => $primary_card['number'],
      'card_expiration' => $primary_card['expiration']
  ];

  $cart_contents = $cart->get_items();
  $books = [
      new Book($dummy_book), new Book($dummy_book)
  ];
  $quantities = [1, 2];

  $db = open_connection();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->prepare("SELECT price,deliver_time
                        FROM state,shipping_zone
                        WHERE state.shipping_code=shipping_zone.code
                          AND state.abbreviation=:abbv;"
  );
  $stmt->execute(['abbv' => $user['state']]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $subtotal = 0;
  $shipping = $result['price'];

  /* generate the info above the table */
  $to_return = '<div id="user-checkout-info" class="box"><h2>' . $title . '</h2>
          <div id="address-info" class="user-info-box box">
            <h3>Shipping Address</h3>' . $user['first_name'] . ' ' . $user['last_name'] . '<br>' . $user['address'] . '<br>' . $user['city'] .
       '<br>' . $user['state'] . ' ' . $user['zip'] . '</div>
          <div id="card-info" class="user-info-box box">
            <h3>Credit Card</h3>';

  if ($confirmation) {
    $to_return .= $user['card_type'] . ': ' . $user['card_number'] . '</div>';
  } else {
    $to_return .= '<input type="radio" name="card-selection"
        value="current-card" id="current-card-radio">
      <div id="current-card" class="user-info-box">
        Use card on file<br>' . $user['card_type'] . ': ' . $user['card_number']
      .'</div>
      <br>
      <input type="radio" name="card-selection" value="new-card"
          id="new-card-radio">
      <div id="new-card" class="user-info-box">
        <input name="new-card-number" type="text" placeholder="Card number">
        <select name="card-type">';

    foreach($card_types as $card_type) {
      $value = strtolower($card_type);
      $to_return .= '<option value="' . $value . '">' . $card_type . '</option>';
    }

    $to_return .= '</select>
        </div>
      </div>';
  }

  if ($confirmation) {
    $to_return .= '<div id="address-info" class="user-info-box box">
          <h3>Confirmation Info</h3>
          <label class="short">Username</label>' . $confirmation['username'] . '<br>
          <label class="short">Date</label>' . $confirmation['date'] . '<br>
          <label class="short">Time</label>' . $confirmation['time'] . '<br>
        </div>';
  }
  /*
  else {
    $db = open_connection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT entry_code,value
      FROM coupon
      WHERE coupon.customer_username=:username
        AND used=0;"
    );
    $stmt->execute(['username' => $_SESSION['login']->get_username()]);
    switch ($stmt->numRows) {
      case 0:
        break;
      case 1:
        break;
      default:
    }
    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $output = new Book($result);

      return $output;
    }
    $to_return .= '<div id="coupon-select" class="box">
          <h3>Select Coupon</h3>
          <label class="short">Username</label>' . $confirmation['username'] . '<br>
          <label class="short">Date</label>' . $confirmation['date'] . '<br>
          <label class="short">Time</label>' . $confirmation['time'] . '<br>
        </div>';
  }
  */

  $to_return .= '</div>';

  /* generate the table */
  $to_return .= '<table id="books-in-cart" class="wide">
              <tr>
                <th>Book Description</th>
                <th class="thin-cell">Qty</th>
                <th class="thin-cell">Price</th>
              </tr>';

  $subtotal = $cart->get_subtotal();

  foreach ($cart_contents as $item) {
    $book = $item['book'];
    $quantity = $item['quantity'];
    $cost = $quantity * $book->price;
    $to_return .= '<tr>
      <td class="book-info">' . $book->generateBookInfo() . '</td>
      <td class="book-info">';
    //if ($confirmation) {
      $to_return .= '<div class="quantity-box centered-input">' . $quantity . '</div>';
    /* } else {
      $to_return .= '<input type="number" name="quantity"
        class="quantity-box centered-input" value="' . $quantity . '">';
    } */
    $to_return .= '</td>
        <td class="book-info">$' . $cost . '</td>
      </tr>';
  }

  $to_return .= '</table>';
  $to_return .= '<div class="box">
                  <div id="shipping-notice" class="user-info-box">
                    <h3>Shipping Note</h3>
                    Books will be delivered within ' . $result['delivery_time'] . ' business days
                  </div>
                  <div id="totals" class="right-aligned user-info-box">
                    <table id="total" class="right-aligned">
                      <tr>
                        <td class="book-info">Subtotal</td>
                        <td class="right-aligned book-info" id="subtotal-cost">' .
                          sprintf("$%.2f", $subtotal) .
                        '</td>
                      </tr>
                      <tr>
                        <td class="book-info">Subtotal</td>
                        <td class="right-aligned book-info" id="shipping-cost">' .
                          sprintf("$%.2f", $shipping) .
                        '</td>
                      </tr>
                      <tr>
                        <td class="book-info">Total</td>
                        <td class="right-aligned book-info" id="total-cost">' .
                          sprintf("$%.2f", $subtotal + $shipping) .
                        '</td>
                      </tr>
                    </table>
                  </div>
                </div>';

  return $to_return;
}

?>
