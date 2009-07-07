<div id="footer">
  <?php
  $updated_since = $this->filebrowser->get_updated_since();
  ?>
    <!-- Removal of link to subfolio.com violates the terms of use  -->
    <a target="_blank" href="http://www.subfolio.com">Subfolio 1.0</a>
    <?php if (view::get_option('display_updated_since', true)) { ?>
    <span class="nav_sep"></span>Updated since:<?php if ($updated_since == "lastweek") { ?><span class="update_toggle">last week</span><?php } else { ?><a href="?updated_since=lastweek" class="update_toggle">last week</a><?php } ?><span class="footer_sep">&#8226;</span><?php if ($updated_since == "lastmonth") { ?><span class="update_toggle">last month</span><?php } else { ?><a href="?updated_since=lastmonth" class="update_toggle">last month</a><?php } ?><span class="footer_sep">&#8226;</span><?php if ($updated_since == "lastvisit") { ?><span class="update_toggle">my last visit</span><?php } else { ?><a href="?updated_since=lastvisit" class="update_toggle">my last visit</a><?php } ?></div>
    <?php } ?>