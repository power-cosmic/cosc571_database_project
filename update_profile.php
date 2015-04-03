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
                'street_address' => $current_address['street_address'],
                'email' => $login->get_email(),
                'address' => $current_address['address'],
                'city' => $current_address['city'],
                'state' => $current_address['state'],
                'zip' => $current_address['zip'],
                'card_type' => $primary_card['issuer'],
                'card_number' => $primary_card['number'],
                'card_expiration' => $primary_card['expiration']
            ];
            print_r($user);
            echo generateGenericForRow('username', $user, false, true);
            echo generateGenericForRow('password', $user, true);
            echo generateGenericForRow('confirm password', $user, true);
            $most_needed_fields = ['first name', 'last name', 'email'];
            foreach ($most_needed_fields as $field) {
              echo generateGenericForRow($field, $user);
            }
            
            ?>
            <div class="form-row">
              <label>Address</label>
              <div class="profile-indent">
                <input type="radio" name="address-selection"
                  value="current-address" id="current-address-radio"
                  class="address-radio">
                Current
                <input type="radio" name="address-selection"
                  value="other-address" id="other-address-radio"
                  class="address-radio">
                Other
                <input type="radio" name="address-selection"
                  value="new-address" id="new-address-radio"
                  class="address-radio">
                New
                <br>
              </div>
              <div id="current-address" class="profile-hidden address-box">
                <?php
                  echo generateGenericForRow('street_address', $user, false, true);
                  echo generateGenericForRow('city', $user, false, true);
                  echo generateGenericForRow('state', $user, false, true);
                  echo generateGenericForRow('zip', $user, false, true);
                ?>
              </div>
              <div id="other-address" class="profile-indent profile-hidden address-box">
                <select name="other-address">
                  <?php
                    foreach ($login->get_addresses() as $address) {
                      echo '<option value="'.$address['id'].'">'.
                          $address['street_address'].' : '.
                          $address['city'].', '.$address['state'].
                          '</option>';
                    }
                  ?>
                </select>
              </div>
              <div id="new-address" class="profile-hidden address-box">
                <?php 
                  echo generateGenericForRow('street_address', []);
                  echo generateGenericForRow('city', []);
                  echo '<div class="form-row"><label for="state">State</label>';
                  echo create_state_dropdown('state', 'mixed', $user['state']);
                  echo '</div>';
                  echo generateGenericForRow('zip', []);
                ?>
              </div>
            </div>
            <br>
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