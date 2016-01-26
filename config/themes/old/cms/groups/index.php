<div class="standard_paragraph">
  <h2>Groups List</h4>
  <?php if ($groups) { ?>
  <table width="100%;">
  <thead>
    <th>Name</th>
    <th>Action</th>
  </thead>
  <?php
    foreach ($groups as $name => $group) { ?>
    <tr>
      <td>
        <a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/groups/view/<?php print $name; ?>"><?php print $name; ?></a>
      </td>
      <td>
        <a onclick="javascript:return confirm('Are you sure?');" href="<?php print SubfolioTheme::get_site_root(); ?>-cms/groups/delete/<?php print $name; ?>">delete</a>
      </td>
    </li>
    <?php } ?>
  </table>
  <?php } else { ?>
  <p>No groups</p>
  <?php }  ?>
</div>
<p><a href="<?php print SubfolioTheme::get_site_root(); ?>-cms/groups/add">Add new group</a></p>
