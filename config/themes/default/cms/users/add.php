<form action="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/create" method="post">

  <?php if (isset($errors)) { ?>
  <span class='big_exclam'>!</span>
  <ul>
    <?php foreach ($errors as $error) { ?>
      <li><?php print $error ?></li>
    <?php } ?>
  </ul>
  <?php } ?>

  <div>
    <label for="name">Login name:</label>
    <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" tabindex="1" />
  </div>

  <div>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" tabindex="2" />
  </div>

  <div>
    <label for="password_again">Password Confirmation:</label>
    <input type="password" name="password_again" id="password_again" value="<?php echo isset($_POST['password_again']) ? $_POST['password_again'] : '' ?>" tabindex="3" />
  </div>

  <div>
    <label for="hash_password">Hash Password?</label>
    <input type="checkbox" name="hash_password" id="hash_password" tabindex="4" value="1"  <?php echo isset($_POST['hash_password']) ? 'checked' : '' ?> />
  </div>

  <div>
    <label for="is_admin">Admin User?</label>
    <input type="checkbox" name="is_admin" id="is_admin" tabindex="5" value="1"  <?php echo isset($_POST['is_admin']) ? 'checked' : '' ?> />
  </div>

  <div>
    <label for="fullname">Full name:</label>
    <input type="text" name="fullname" id="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>" tabindex="6" />
  </div>

  <div>
    <input type="submit" value="Submit" />
  </div>
</form>

