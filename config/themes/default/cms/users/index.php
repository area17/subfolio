<div class="standard_paragraph">
  <h4>User List</h4>
  <table width="100%;">
  <thead>
    <th>Name</th>
    <th>Full Name</th>
    <th>Admin?</th>
    <th>Action</th>
  </thead>
  <?php
    foreach ($users as $name => $user) { ?>
    <tr>
      <td>
        <a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/edit/<?php print $name; ?>"><?php print $name; ?></a>
      </td>
      <td>
        <?php print $user['fullname'] ?>
      </td>
      <td>
        <?php if ($user['admin']) print "Yes" ?>
      <td>
        <a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/edit/<?php print $name; ?>">edit</a> &bull;
        <a onclick="javascript:return confirm('are you sure?');" href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/delete/<?php print $name; ?>">delete</a>
      </td>
    </li>
    <?php }
  ?>
  </table>
</div>
<p><a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/users/add">Add new user</a></p>
