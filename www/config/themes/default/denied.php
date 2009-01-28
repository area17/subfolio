<div id='lock' class='clearfix'>

	<div class="locker" >
		<div style="padding-bottom:0;"><img src="<?php echo view::get_view_url() ?>/images/i_lock_exclam.gif" width="30" height="33" border="0" /></div>
		<p><span  class='error'><?php echo Kohana::lang('filebrowser.accessdenied');?>:</span><br/><?php echo Kohana::lang('filebrowser.youdonthaveaccesstothisdirectory');?><br/>
		<a href="/login"><?php echo Kohana::lang('filebrowser.loginasadifferentuser');?></a></p>
	</div>
	
</div>	