<div id='lock' class='clearfix'>

<form action="/login" method="post" name="protection">

  <input type="hidden" name="login" value="login">

<div class="locker" >

	<div style="padding-bottom:0;"><img src="/themes/default/images/i_lock_exclam.gif" width="30" height="33" border="0" /></div>
	
	<?php if ($login_failed) { ?>
    <p><span  class='error'>Error:</span> Invalid username or password.</p>	
  <?php } else { ?>
	  <p>Enter your username and password:</p>
	<?php } ?>

	<input type="text"      value="<?php print ""; ?>" name="username" class="field" tabindex="1" /><br />
	<input type="password"  value="<?php print ""; ?>" name="password" class="field" tabindex="2" />
	
	<div class="checkbox" style="padding-bottom:5px;"><input type="checkbox" value="1" name="remember" tabindex="4" CHECKED />remember my login</div>
	
	<div class="subButton copy"><a href="javascript:void(document.protection.submit())" type="submit">Submit</a></div>
	<div class="clear"><!-- --></div>
	
</div>

</form>
</div>	