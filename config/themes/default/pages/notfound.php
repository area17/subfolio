<div style="padding-bottom:5px;"><img src="<?php echo view::get_view_url() ?>/images/system/i_404.gif" width="40" height="35" border="0" /></div>
<p><?php echo Kohana::lang('filebrowser.notfound');?><br/>
<?php echo Kohana::lang('filebrowser.check_url_go_back', '<a href="'.dirname($this->filebrowser->file).'">Parent Directory</a>');?>
</p>