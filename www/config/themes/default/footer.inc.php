<div id="footer" class="clearfix">
  <?php
  $updated_since = $this->filebrowser->get_updated_since();
  ?>

  <p>
	Updated since: 
   <?php if ($updated_since == "lastweek") { ?>
	   last week
   <?php } else { ?>
	   <a href="&updated_since=lastweek">last week</a>
   <?php } ?>

 | 
   <?php if ($updated_since == "lastmonth") { ?>
		last month
   <?php } else { ?>
		<a href="&updated_since=lastmonth">last month</a>
   <?php } ?>
 
 | 
   <?php if ($updated_since == "lastvisit") { ?>
		my last visit
   <?php } else { ?>
		<a href="&updated_since=lastvisit">my last visit</a>
   <?php } ?>
  </p>

	<p class="copyright">Subfolio Portable &copy; <?php echo date("Y"); ?> <a target="_blank" href="http://www.area17.com">Area 17</a> Media LLC &ndash; All rights reserved</p>
	
</div>