<div id="footer" class="clearfix">

  <?php require("prev_next.inc.php") ?>

  <?php
  $updated_since = $this->filebrowser->get_updated_since();
  ?>

  <p>
	Updated since: 
   <?php if ($updated_since == "lastweek") { ?>
	   last week
   <?php } else { ?>
	   <a href="?updated_since=lastweek">last week</a>
   <?php } ?>

 | 
   <?php if ($updated_since == "lastmonth") { ?>
		last month
   <?php } else { ?>
		<a href="?updated_since=lastmonth">last month</a>
   <?php } ?>
 
 | 
   <?php if ($updated_since == "lastvisit") { ?>
		my last visit
   <?php } else { ?>
		<a href="?updated_since=lastvisit">my last visit</a>
   <?php } ?>
  </p>

	<p class="copyright">
	  <!-- Removal of link to subfolio.com violates the terms of use  -->
	  Content Copyright &copy; 2009 AREA 17, all rights reserved &ndash; This is a <a target="_blank" href="http://www.subfolio.com">Subfolio</a>
  </p>
	
</div>