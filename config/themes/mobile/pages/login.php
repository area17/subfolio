<!-- Error -->
<?php if ($login_failed) { ?>
	<div class="login_error">
		<b><?php echo SubfolioLanguage::get_text('error');?></b>: <?php echo SubfolioLanguage::get_text('invalid_user_password'); ?>
	</div>
<?php } ?>

<div id="lock">
	
	<!-- Form -->
	<form action="/login" method="post" name="protection">
		<input type="hidden" name="login" value="login">

		<!-- Username -->
		<label><?php echo SubfolioLanguage::get_text('username');?></label>
		<input type="text" value="" id="username" name="username" class="field" tabindex="1" />
		<script type="text/javascript">
			document.getElementById('username').focus();
		</script>
		
		<!-- Password -->
		<label><?php echo SubfolioLanguage::get_text('password');?></label>
		<input type="password"  value="" id="password" name="password" class="field" tabindex="2" />

		<!-- Remember me -->
		<div class="checkbox">
			<input id="remember_me" type="checkbox" value="1" name="remember" tabindex="4" CHECKED />
			<label for="remember_me"><?php echo SubfolioLanguage::get_text('remember_my_login');?></label>
		</div>
		
		<!-- Submit -->
		<input id="submit" type="submit" value="<?php echo SubfolioLanguage::get_text('submit');?>" name="submit"/>
		
	</form>
</div>
