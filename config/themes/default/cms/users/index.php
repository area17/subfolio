<div class="standard_paragraph">
  <h4>User List</h4>
  <ul>
  <?php
    foreach ($users as $name => $user) { ?>
    <li><a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/edit/<?php print $name; ?>"><?php print $name; ?></a></li>
    <?php }
  ?>
  </ul>
</div>
<p><a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/add">Add new user</a></p>
