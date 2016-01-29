<div class="standard_paragraph">
  <h2>Groups Members: <?php echo $groupname; ?></h4>

  <ul>
  <?php 
  $count = 0;
  foreach ($group as $user) { 
    if ($user <> '') {
      $count ++;
    ?>
    <li><?php print $user; ?></li>
  <?php 
    }
  } 

  if ($count == 0) { ?>
    <li>No users have been added to this group.</li>
  <?php } ?>
  </ul>
</div>