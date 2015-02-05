<?php
include_once 'admin/php/us_state_dropdown.php';

/* 
 * TODO: select credit card type based on $user
 * TODO: get $user from db
 */

function createProfileForm($username = null) {
  
  $user_data = null;
  $disabled = ($username == null)? 'disabled': '';

  if ($username) {
    /* TODO: get user data from db */
    $user = [
        'username' => 'coolguy49',
        'first_name' => 'Luke',
        'last_name' => 'Skywalker',
        'address' => '48 Williams St.',
        'city' => 'Tatooine',
        'state' => 'Skywalker',
        'zip' => '48197',
        'card_type' => 'VISA',
        'card_number' => '1111222233334444',
        'card_expiration' => '04/16'
    ];
  }
    
  $to_return = '<form method="post" action="<?=$_SERVER[\'PHP_SELF\']?>">'
            .generateGenericForRow("username", $user, $false, $username != null);
  
            if (!$user) {
              $to_return .= generateGenericForRow("password", $user)
                  .generateGenericForRow("confirm password", $user);
            }
  
            $most_needed_fields = ['first name', 'last name', 'address', 'city'];
            foreach ($most_needed_fields as $field) {
              $to_return .= generateGenericForRow($field, $user);
            }
            
            $to_return .= '<div class="form-row">
              <label for="state">State</label>'
              .create_state_dropdown()
              .'<label class="short" for="zip">Zip</label>
              <input class="short" type="text" name="zip" id="zip" placeholder="12345" value="'.$user['zip'].'">
             </div>
             <div class="form-row">
              <label for="card-type">Credit card</label>
              <select name="card-type" value="asdf">
                <option value="visa">VISA</option>
                <option value="mc">MasterCard</option>
              </select>
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
  
  return '<div class="form-row">
    <label for="'.$hyphenated.'">'.$capitalized.'</label>
    <input type="'.$input_type.'" name="'.$hyphenated.'" id="'.$hyphenated.'" placeholder="'.$capitalized.'" value="'.$user[$underscored].'" '.$disabled_string.'>
  </div>';
}
?>