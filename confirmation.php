<?php
include_once 'admin/php/inserters/credit_card_inserter.php';
include_once 'admin/php/cart.php';
include_once 'admin/php/common.php';
include_once 'admin/php/connection.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/book_info.php';
include_once 'admin/php/confirmation_table.php';
include_once 'admin/php/login.php';

session_start();
?>
<!doctype html>
<html>
  <?=createBasicHead('Confirmation', null, ['book_table.css'])?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">
        <div id="cart" class="centered box">
          <form method="post" action="<?=$_SERVER['PHP_SELF']?>">

            <?php
              $confirmation = null;
              $db = open_connection();
              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $cart = Cart::get_instance();
              $login = Login::get_instance();
              $card_number = $login->get_primary_card()['number'];

              try {
                
                if ($_POST['card-selection'] == 'new-card') {
                  $card_number = $_POST['new-card-number'];
                  $card_inserter = new Credit_card_inserter($db);
                  $card_inserter->insert([
                      'number' => $card_number,
                      'issuer' => $_POST['card-type'],
                      'expiration' => '2015-02-02',       // TODO: get actual date
                      'username' => $login->get_username()
                  ]);
                }
                
                $subtotal = $cart->get_subtotal();
                
                $query = 'INSERT INTO sales_order
                    ( customer_username,
                      address_id,
                      credit_card_number,
                      total_cost,
                      shipping_cost,
                      submit_date
                    ) values (
                      :username,
                      :address_id,
                      :credit_card_number,
                      :total_cost,
                      :shipping_cost,
                      NOW()
                    );
                  ';
                $stmt = $db->prepare($query);
                $stmt->execute([
                    'username' => $login->get_username(),
                    'address_id' => $card_number,
                    'credit_card_number' => $login->get_primary_card(),
                    'total_cost' => $subtotal + 4,
                    'shipping_cost' => 4
                ]);
                
                $order_id = $this->db->lastInsertId();
                $cart_contents = $cart->get_items();
                $sql = 'INSERT INTO order_item VALUES
                        ( :order_id
                        , :isbn
                        , :quantity);';
                $stmt = $db->prepare($sql);
                
                foreach ($cart_contents as $item) {
                  $book = $item['book'];
                  
                  $stmt->execute([
                      'order_id' => $order_id,
                      'isbn' => $book->isbn,
                      'quantity' => $item['quantity']
                  ]);
                  
                }
                
                // get some info
                
              } catch (PDOException $e) {
                print_r($e);
              }
              
              $sql = 'SELECT submit_date
                  FROM sales_order
                  WHERE id = ' . $order_id . ';';
              $stmt = $db->prepare($sql);
              $stmt->execute();
              
              if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $date_and_time = explode(' ', $result['submit_date']);
                $confirmation=[
                    'username' => $login->get_username,
                    'date' => $date_and_time[0],
                    'time' => $date_and_time[1]
                ];
              }
              
              
            ?>

            <?=generate_confirmation_table("Confirmation", null, null, $confirmation)?>
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>