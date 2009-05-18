<div id='lock' class='clearfix'>

<form action="/login" method="post" name="protection">

  <input type="hidden" name="login" value="login">

<div class="locker" >

	<div style="padding-bottom:0;"><img src="<?php echo view::get_view_url() ?>/images/icons/i_lock_exclam.gif" width="30" height="33" border="0" /></div>
	
	<?php if ($login_failed) { ?>
    <p><span  class='error'><?php echo Kohana::lang('filebrowser.error');?>:</span> <?php echo Kohana::lang('filebrowser.invalid_user_password');?></p>	
  <?php } else { ?>
	  <p><?php echo Kohana::lang('filebrowser.enter_user_password');?>:</p>
	<?php } ?>

	<input type="text"      value="<?php print ""; ?>" name="username" class="field" tabindex="1" /><br />
	<input type="password"  value="<?php print ""; ?>" name="password" class="field" tabindex="2" />
	
	<div class="checkbox" style="padding-bottom:5px;"><input type="checkbox" value="1" name="remember" tabindex="4" CHECKED /><?php echo Kohana::lang('filebrowser.remember_my_login');?></div>
	
	<div class="subButton copy"><a href="javascript:void(document.protection.submit())" type="submit"><?php echo Kohana::lang('filebrowser.submit');?></a></div>
	<div class="clear"><!-- --></div>
	
</div>

</form>
</div>	