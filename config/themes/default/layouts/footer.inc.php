<div id="footer">
  <?php
  $updated_since = $this->filebrowser->get_updated_since();
  ?>
    <!-- Removal of link to subfolio.com violates the terms of use  -->
    <a id="footer-home" target="_blank" href="http://www.subfolio.com">Subfolio 1.0</a>
    <?php if (view::get_option('display_updated_since', true)) { ?>
    	<span>Updated since:</span>
			<?php if ($updated_since == "lastweek") { ?><span>last week</span><?php } else { ?><a href="?updated_since=lastweek">last week</a><?php } ?>
			<span class="footer_sep">&#8226;</span>
			<?php if ($updated_since == "lastmonth") { ?><span>last month</span><?php } else { ?><a href="?updated_since=lastmonth">last month</a><?php } ?>
			<span class="footer_sep">&#8226;</span>
			<?php if ($updated_since == "lastvisit") { ?><span>my last visit</span><?php } else { ?><a href="?updated_since=lastvisit">my last visit</a><?php } ?></div>
    <?php } ?>