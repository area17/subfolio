  <div class="standard_paragraph">
    <h4>User Details: <?php print $user->name; ?></h4>

    <form action="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/edit/<?php print $user->name ?>" method="post">

      <?php if ($_POST && isset($errors)) { ?>
      <span class='big_exclam'>!</span>
      <ul>
        <?php foreach ($errors as $error) { ?>
          <li><?php print $error ?></li>
        <?php } ?>
      </ul>
      <?php } ?>

      <div>
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" tabindex="2" />
      </div>

      <div>
        <label for="password_again">New Password Confirmation:</label>
        <input type="password" name="password_again" id="password_again" value="<?php echo isset($_POST['password_again']) ? $_POST['password_again'] : '' ?>" tabindex="3" />
      </div>

      <div>
        <label for="hash_password">Hash Password?</label>
        <input type="checkbox" name="hash_password" id="hash_password" tabindex="4" value="1"  <?php echo isset($_POST['hash_password']) ? 'checked' : '' ?> />
      </div>

      <div>
        <?php 
          $adminChecked = '';
          if ($_POST) {
            $adminChecked = isset($_POST['is_admin']) ? 'checked' : '';
          } else {
            $adminChecked = $user->admin ? 'checked' : '';
          }
        ?>
        <label for="is_admin">Admin User?</label>
        <input type="checkbox" name="is_admin" id="is_admin" tabindex="5" value="1"  <?php echo $adminChecked; ?> />
      </div>

      <div>
        <label for="fullname">Full name:</label>
        <input type="text" name="fullname" id="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : $user->fullname; ?>" tabindex="6" />
      </div>

      <div>
        <input type="submit" value="Submit" />
      </div>

    </form>

    <hr />

    <h4>Groups</h4>

    <ul>
    <?php foreach ($groups as $name => $group) { ?>
      <li><?php print $name; ?>
          <?php if ($auth->in_group($user, $name)) {  ?>
          <a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/removefromgroup/<?php print $user->name; ?>?group=<?php print $name; ?>">Remove from Group</a>
          <?php } else { ?>
          <a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/addtogroup/<?php print $user->name; ?>?group=<?php print $name; ?>">Add to Group</a>
          <?php } ?>
      </li>
    <?php } ?>
    </ul>

  </div>