  <div id="lock" class="cms">
    
    <div class="login_header"><b>User Details: <?php print $user->name; ?></b></div>
    <?php if ($_POST && isset($errors)) { ?>
    <div class="login_feedback">
      <ul>
        <?php foreach ($errors as $error) { ?>
          <li><?php print $error ?></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>
    <form action="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/edit/<?php print $user->name ?>" method="post">
      
      <div class="login_field">
        <label for="fullname">Full name:</label>
        <input type="text" name="fullname" id="fullname" class="field" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : $user->fullname; ?>" tabindex="6" />
      </div>

      <div class="login_field">
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" class="field" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" tabindex="2" />
      </div>

      <div class="login_field">
        <label for="password_again">Confirm Password:</label>
        <input type="password" name="password_again" id="password_again" class="field" value="<?php echo isset($_POST['password_again']) ? $_POST['password_again'] : '' ?>" tabindex="3" />
      </div>

      <div class="checkbox">
        <input type="checkbox" name="hash_password" id="hash_password" tabindex="4" value="1"  <?php echo isset($_POST['hash_password']) ? 'checked' : '' ?> />
        <label for="hash_password">Hash Password?</label>
      </div>

      <div class="checkbox">
        <?php 
          $adminChecked = '';
          if ($_POST) {
            $adminChecked = isset($_POST['is_admin']) ? 'checked' : '';
          } else {
            $adminChecked = $user->admin ? 'checked' : '';
          }
        ?>
        <input type="checkbox" name="is_admin" id="is_admin" tabindex="5" value="1"  <?php echo $adminChecked; ?> />
        <label for="is_admin">Admin User?</label>
      </div>

      <div class="subButton copy">
        <input type="submit" value="Submit" />
      </div>

    </form>
  </div>
  <?php if ($groups) { ?>
    <div class="standard_paragraph cms">
      <h4>Groups</h4>

      <ul class="group">
      <?php foreach ($groups as $name => $group) { ?>
        <li>
            <b><?php print $name; ?></b>
            <?php if ($auth->in_group($user, $name)) {  ?>
            <a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/removefromgroup/<?php print $user->name; ?>?group=<?php print $name; ?>">Remove from Group</a>
            <?php } else { ?>
            <a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/addtogroup/<?php print $user->name; ?>?group=<?php print $name; ?>">Add to Group</a>
            <?php } ?>
        </li>
      <?php } ?>
      </ul>
  </div>
  <?php } ?>