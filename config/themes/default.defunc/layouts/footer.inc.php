<div id="footer">
  <?php
  $updated_since = $this->filebrowser->get_updated_since();
  ?>
    <!-- Removal of link to subfolio.com violates the terms of use  -->
    <a id="footer-home" target="_blank" href="http://www.subfolio.com">Subfolio</a>
    <?php if (view::get_option('display_updated_since', true)) { ?>
    	<span><?php echo Kohana::lang('filebrowser.updated_since'); ?></span>
			<?php if ($updated_since == "lastweek") { ?><span><?php echo Kohana::lang('filebrowser.last_week'); ?></span><?php } else { ?><a href="?updated_since=lastweek"><?php echo Kohana::lang('filebrowser.last_week'); ?></a><?php } ?>
			<span class="footer_sep">&#8226;</span>
			<?php if ($updated_since == "lastmonth") { ?><span><?php echo Kohana::lang('filebrowser.last_month'); ?></span><?php } else { ?><a href="?updated_since=lastmonth"><?php echo Kohana::lang('filebrowser.last_month'); ?></a><?php } ?>
			<span class="footer_sep">&#8226;</span>
			<?php if ($updated_since == "lastvisit") { ?><span><?php echo Kohana::lang('filebrowser.my_last_visit'); ?></span><?php } else { ?><a href="?updated_since=lastvisit"><?php echo Kohana::lang('filebrowser.my_last_visit'); ?></a><?php } ?></div>
    <?php } ?>