<form action="<?php print SubfolioTheme::get_site_root(); ?>-cms/groups/create" method="post">

  <?php if (isset($errors)) { ?>
  <span class='big_exclam'>!</span>
  <ul>
    <?php foreach ($errors as $error) { ?>
      <li><?php print $error ?></li>
    <?php } ?>
  </ul>
  <?php } ?>

  <div>
    <label for="name">Group name:</label>
    <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" tabindex="1" />
  </div>

  <div>
    <input type="submit" value="Submit" />
  </div>
</form>

