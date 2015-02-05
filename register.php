<?php
include_once 'admin/php/constants.php';
include_once 'admin/php/common.php';
include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?= createBasicHead('Register')?>
  <body>
    <div id="container">
      <?=createHeader(true, false)?>
      <div class="content">
        <div id="login" class="centered box">
          <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
            <div class="form-row">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" placeholder="username">
            </div>
            <div class="form-row">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" placeholder="password">
            </div>
            <div class="form-row">
              <label for="password2">Confirm Password</label>
              <input type="password" name="password2" id="password2" placeholder="password">
             </div>
             <div class="form-row">
              <label for="first-name">First name</label>
              <input type="text" name="first-name" id="first-name" placeholder="First name">
             </div>
             <div class="form-row">
              <label for="last-name">Last name</label>
              <input type="text" name="last-name" id="last-name" placeholder="Last name">
             </div>
             <div class="form-row">
              <label for="address">Address</label>
              <input type="text" name="address" id="address" placeholder="Address">
             </div>
             <div class="form-row">
              <label for="city">City</label>
              <input type="text" name="city" id="city" placeholder="City">
             </div>
             <div class="form-row">
              <label for="state">State</label>
              <select name="stat">
                <!-- TODO: generate all states -->
                <option value="mi">MI</option>
                <option value="ny">NY</option>
              </select>
                <label class="short" for="zip">Zip</label>
                <input class="short" type="text" name="zip" id="zip" placeholder="12345">
             </div>
             <div class="form-row">
              <label for="card-type">Credit card</label>
              <select name="stat">
                <option value="visa">VISA</option>
                <option value="mc">MasterCard</option>
              </select>
             </div>
             <div class="form-row">
              <label for="card-number">Card number</label>
              <input type="text" name="card-number" id="card-number" placeholder="Credit card number">
             </div>
             <div class="form-row">
              <label for="card-expiration">Expiration date</label>
              <input type="text" name="card-expiration" id="card-expiration" placeholder="MM/YY">
             </div>
            <input type="submit" value="Register" class="green button">
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>