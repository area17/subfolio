<div id="lock" class="cms">
  <div class="login_header"><b>Create new user</b></div>
  <?php if (isset($errors)) { ?>
  <div class="login_feedback">
    <ul>
      <?php foreach ($errors as $error) { ?>
        <li><?php print $error ?></li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
  <form action="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/create" method="post">
    
    <div class="login_field">
      <label for="fullname">Full name:</label>
      <input type="text" name="fullname" id="fullname" class="field" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>" tabindex="6" />
    </div>

    <div class="login_field">
      <label for="name">Login name:</label>
      <input type="text" name="name" id="name" class="field" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" tabindex="1" />
    </div>

    <div class="login_field">
      <label for="password">Password:</label>
      <input type="password" name="password" class="field" id="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" tabindex="2" />
    </div>

    <div class="login_field">
      <label for="password_again">Confirm Password:</label>
      <input type="password" name="password_again" id="password_again" class="field" value="<?php echo isset($_POST['password_again']) ? $_POST['password_again'] : '' ?>" tabindex="3" />
    </div>

    <div class="checkbox">
      <label for="hash_password">Hash Password?</label>
      <input type="checkbox" name="hash_password" id="hash_password" tabindex="4" value="1"  <?php echo isset($_POST['hash_password']) ? 'checked' : '' ?> />
    </div>

    <div class="checkbox">
      <label for="is_admin">Admin User?</label>
      <input type="checkbox" name="is_admin" id="is_admin" tabindex="5" value="1"  <?php echo isset($_POST['is_admin']) ? 'checked' : '' ?> />
    </div>

    <div class="subButton copy">
      <input type="submit" value="Submit" />
    </div>
  </form>
</div>

