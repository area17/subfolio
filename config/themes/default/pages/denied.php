<p>
	<?php echo SubfolioLanguage::get_text('accessdenied'); ?><br/>
	<?php if (SubfolioUser::is_logged_in()) { ?>
	<a href="/logout"><?php echo SubfolioLanguage::get_text('loginasadifferentuser');?></a>
	<?php } else { ?>
	<a href="/login"><?php echo SubfolioLanguage::get_text('loginasadifferentuser');?></a>
	<?php } ?>
</p>