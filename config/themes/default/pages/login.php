<div id="lock">

	<div class="login_header"><img src='<?php echo view::get_view_url() ?>/images/system/authentification.gif' width='9' height='12' border='0' />Authentification Required</div>

	<form action="/login" method="post" name="protection">
	
		<input type="hidden" name="login" value="login">

		<div class="login_field"><label>User Name : </label><input type="text" value="<?php print ""; ?>" name="username" class="field" tabindex="1" /></div>
		<div class="login_field"><label>Password : </label><input type="password"  value="<?php print ""; ?>" name="password" class="field" tabindex="2" /></div>
		<div class="checkbox">
			<input type="checkbox" value="1" name="remember" tabindex="4" CHECKED /><?php echo Kohana::lang('filebrowser.remember_my_login');?>
		</div>
		<div class="subButton copy">
			<a href="javascript:void(document.protection.submit())" type="submit"><?php echo Kohana::lang('filebrowser.submit');?></a>
		</div>
			
	</form>

</div>

<div class="login_info">	
	<?php if ($login_failed) { ?>
	<span class="error"><img src='<?php echo view::get_view_url() ?>/images/system/authentification_exclam.gif' width='59' height='59' border='0' /></span><span class="text"><?php echo Kohana::lang('filebrowser.error');?>: <?php echo Kohana::lang('filebrowser.invalid_user_password');?></span>
	<?php } ?>
</div>