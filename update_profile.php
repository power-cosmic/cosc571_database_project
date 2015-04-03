<?php
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
include_once 'admin/php/constants.php';
include_once 'admin/php/login.php';
include_once 'admin/php/profile.php';
include_once 'admin/php/us_state_dropdown.php';

session_start();

$username = ($_SESSION['username']) ? $_SESSION['username'] : 'unknown';
?>
<!doctype html>
<html>
  <?=createBasicHead('Update', 'profileUpdate')?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">
        <div id="profile" class="centered box">
        
          <form id="register" method="post">
          
            <?php
            $login = Login::get_instance();
            $current_address = $login->get_primary_address();
            $primary_card = $login->get_primary_card();
            
            $user = [
                'username' => $login->get_username(),
                'first_name' => $login->get_first_name(),
                'last_name' => $login->get_last_name(),
                'address' => $current_address['street_address'],
                'email' => $login->get_email(),
                'city' => $current_address['city'],
                'state' => $current_address['state'],
                'zip' => $current_address['zip'],
                'card_type' => $primary_card['issuer'],
                'card_number' => $primary_card['number'],
                'card_expiration' => $primary_card['expiration']
            ];

            echo generateGenericForRow('username', $user, false, true);
            echo generateGenericForRow('password', $user, true);
            echo generateGenericForRow('confirm password', $user, true);
            $most_needed_fields = ['first name', 'last name', 'email'];
            foreach ($most_needed_fields as $field) {
              echo generateGenericForRow($field, $user);
            }
            
            ?>
            
            <div id="new-address">
              <?php 
                echo generateGenericForRow('city', $user);
                echo '<div class="form-row"><label for="state">State</label>';
                echo create_state_dropdown('state', 'mixed', $user['state']);
                echo '</div>';
                echo generateGenericForRow('zip', $user);
              ?>
            </div>
            
            <div id="new-card">
              <?php 
                $card_types = ['MasterCard', 'VISA'];
                
                echo '<div class="form-row"><label for="card-type">Credit card</label>';
                echo '<select name="card-type">';
                foreach ($card_types as $card_type) {
                  $value = strtolower($card_type);
                  $selected = (!strcmp($card_type, $user['card_type']))? 'selected = "selected"': '';
                  echo "<option value=\"$value\" $selected>$card_type</option>";
                }
                echo '</select></div>';
                echo generateGenericForRow('card number', $user);
                echo generateGenericForRow('card expiration', $user);
              ?>
            </div>
            <input type="submit" value="Update" id="submit" class="green button">
          </form>
        
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>