<header>
	
	<!-- Home or left mask -->
	<?php if (SubfolioFiles::is_root()) { ?>
		<span id='left'></span>
	<?php } else { ?>
		<a href='<?php print Kohana::config('filebrowser.site_root'); ?>' id='home'>Some</a>
	<?php } ?>
		
	<!-- Logout or right mask -->
	<?php if (SubfolioUser::is_logged_in()) { ?>
		<a href='<?php print Kohana::config('filebrowser.site_root'); ?>logout' id='logout'>Logout</a>
	<?php } else { ?>
		<span id='right'></span>
	<?php } ?>
	
	<?php if (SubfolioFiles::is_root()) { ?>
		<h1 class="h1_home"><?php echo SubfolioTheme::get_site_title(); ?></h1>
	<?php } else { ?>
		<h1 class="h1"><?php echo Subfolio::current_file('filename'); ?></h1> 
	<?php } ?>
</header>

<?php if (!SubfolioFiles::is_root()) { ?>
	<nav>
		<span class='parent_dir'><?php echo SubfolioFiles::parent_link(SubfolioLanguage::get_text('parent_directory')); ?></span>
		<span class='prev_next'>
			<?php echo SubfolioFiles::previous_link_or_span(SubfolioLanguage::get_text('previous'), SubfolioLanguage::get_text('previous_directory'), 'previous', 'faded'); ?><?php echo SubfolioFiles::next_link_or_span(SubfolioLanguage::get_text('next'), SubfolioLanguage::get_text('next_directory'), 'next', 'faded'); ?>
		</span>	
	</nav>
<?php } ?>