<div id="lock" class="cms">
  <div class="login_header"><b>Create new group</b></div>
  <?php if (isset($errors)) { ?>
  <div class="login_feedback">
    <ul>
      <?php foreach ($errors as $error) { ?>
        <li><?php print $error ?></li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
  <form action="<?php print SubfolioTheme::get_site_root(); ?>-cms/groups/create" method="post">

    <div class="login_field" style="padding-bottom: 20px;">
      <label for="name">Group name:</label>
      <input type="text" name="name" id="name" class="field" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" tabindex="1" />
    </div>

    <div class="subButton copy">
      <input type="submit" value="Submit" />
    </div>
  </form>
</div>
