<?php
include_once 'admin/php/connection.php';
include_once 'admin/php/us_state_dropdown.php';
include_once 'admin/php/inserters/address_inserter.php';
include_once 'admin/php/inserters/credit_card_inserter.php';

/* 
 * TODO: select credit card type based on $user
 * TODO: get $user from db
 */

function createProfileForm($username = null) {
  
  $user_data = null;
  $disabled = ($username == null)? 'disabled': '';
  
  $card_types = ['MasterCard', 'VISA'];
  
  // check post
  if(!$username && count($_POST) > 0) {
    // TODO: validation
    
    $db = open_connection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $address_info = [
        'street_address' => $_POST['address'],
        'city' => $_POST['city'],
        'zip' => $_POST['zip'],
        'state' => $_POST['state'],
    ];
    $address_inserter = new Address_inserter($db);
    $address_id = $address_inserter->insert($address_info)['id'];
    
    $insert_customer = "INSERT INTO customer (
          username, 
          password,
          first_name,
          last_name,
          address_id
        ) VALUES (
          :username,
          PASSWORD(:password),
          :first_name,
          :last_name,
          :address_id
      );";
    
    $stmt = $db->prepare($insert_customer);
    
    
    $stmt->execute([
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'first_name' => $_POST['first-name'],
        'last_name' => $_POST['last-name'],
        'address_id' => $address_id
    ]);
    
    $card_inserter = new Credit_card_inserter($db);
    
    $card_id = $card_inserter->insert([
        'username' => $_POST['username'],
        'number' => $_POST['card-number'],
        'issuer' => $_POST['card-type'],
        'expiration' => $_POST['card-expiration']
    ]);
  
  }
  
  
  if ($username) {
    /* TODO: get user data from db */
    $user = [
        'username' => 'coolguy49',
        'first_name' => 'Luke',
        'last_name' => 'Skywalker',
        'email' => 'a@a.a',
        'address' => '48 Williams St.',
        'city' => 'Tatooine',
        'state' => 'MI',
        'zip' => '48197',
        'card_type' => 'VISA',
        'card_number' => '1111222233334444',
        'card_expiration' => '04/16'
    ];
  }
    
  $to_return = '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">'
      .generateGenericForRow("username", $user, $false, $username != null);
    
      if (!$user) {
        $to_return .= generateGenericForRow("password", $user, true)
            .generateGenericForRow("confirm password", $user, true);
      }
    
      $most_needed_fields = ['first name', 'last name', 'email', 'address', 'city'];
      foreach ($most_needed_fields as $field) {
        $to_return .= generateGenericForRow($field, $user);
      }
            
      $to_return .= '<div class="form-row">
            <label for="state">State</label>'
          .create_state_dropdown('state', 'mixed', $user['state'])
          .'</div>'
          .generateGenericForRow('zip', $user)
         .'<div class="form-row">
          <label for="card-type">Credit card</label>
          <select name="card-type">';

      foreach ($card_types as $card_type) {
        $value = strtolower($card_type);
        $selected = (!strcmp($card_type, $user['card_type']))? 'selected = "selected"': '';
        $to_return .= "<option value=\"$value\" $selected>$card_type</option>"; 
      }
      $to_return .= '</select>
         </div>'
         .generateGenericForRow('card number', $user)
         .generateGenericForRow('card expiration', $user)
         .'<input type="submit" value="Register" class="green button">
      </form>'; 
  
  return $to_return;
}

function generateGenericForRow($field_name, $user, $password = false, $disabled = false) {
  $parts = explode(' ', $field_name);
  $underscored = implode('_', $parts);
  $hyphenated = implode('-', $parts);
  $capitalized = ucfirst($field_name);
  
  $input_type = ($password)? 'password': 'text';
  $disabled_string = ($disabled)? ' disabled': '';
  $classes = ($disabled)? 'disabled-input': '';
  
  return '<div class="form-row">
    <label for="'.$hyphenated.'">'.$capitalized.'</label>
    <input type="'.$input_type.'" name="'.$hyphenated.'" id="'.$hyphenated.'" class="'.$classes.'"
        placeholder="'.$capitalized.'" value="'.$user[$underscored].'" '.$disabled_string.'>
  </div>';
}

?>