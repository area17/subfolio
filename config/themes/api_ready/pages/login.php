<div id="lock">

	<div class="login_header"><b><?php echo API_Language('filebrowser.authenticationrequired');?></b></div>

	<form action="/login" method="post" name="protection">
	
		<input type="hidden" name="login" value="login">

		<div class="login_field">
			<label><?php echo API_Language('filebrowser.username');?></label>
			<input type="text" value="" id="username" name="username" class="field" tabindex="1" />
		</div>
		<script type="text/javascript">
			document.getElementById('username').focus();
		</script>
		<div class="login_field">
			<label><?php echo API_Language('filebrowser.password');?></label>
			<input type="password"  value="" id="password" name="password" class="field" tabindex="2" />
		</div>
		
		<div class="checkbox">
			<input id="remember_me" type="checkbox" value="1" name="remember" tabindex="4" CHECKED />
			<label for="remember_me"><?php echo API_Language('filebrowser.remember_my_login');?></label>
		</div>
		<div class="subButton copy">
			<input id="contact_submit" type="submit" value="<?php echo Kohana::lang('filebrowser.submit');?>" name="commit"/>
		</div>
		
	</form>

</div>

<div class="login_info">	
	<?php if ($login_failed) { ?>
		<span class="error">
			<img src='<?php echo API_ViewUrl() ?>/images/system/authentification_exclam.gif' width='59' height='59' border='0' />
		</span>
		<span class="text">
			<b><?php echo API_Language('filebrowser.error');?>: <?php echo API_Language('filebrowser.invalid_user_password'); ?></b>
		</span>
	<?php } ?>
</div>