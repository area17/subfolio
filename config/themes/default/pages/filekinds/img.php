<?php /* Should the image be inlined or just show download info? */

$max_size = Subfolio::get_setting('display_max_filesize');
$size = Subfolio::current_file('rawsize');

if ($size > ($max_size * 1024 * 1024)) {
  require("_download_box.php");
} else { ?>
  <img width="<?php echo Subfolio::current_file('width') ?>" height="<?php echo Subfolio::current_file('height') ?>" src="<?php echo Subfolio::current_file('url') ?>" class="detailIMG" srcset="<?php echo Subfolio::current_file('retina') ?> 2x" data-behavior="toggle_img" />
  <?php if (SubfolioTheme::get_option('display_info')) { require("_hideable_download_box.php"); } ?>
<?php } ?>