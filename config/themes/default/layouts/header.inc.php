<?php
    $showHide = "showSwitch";
    $showHideLabel = "".Kohana::lang('filebrowser.collapseheader');
    if (isset($_COOKIE['logo'])) {
        if ($_COOKIE['logo'] == "hideSwitch") {
            $showHide = "hideSwitch";
            $showHideLabel = "".Kohana::lang('filebrowser.expandheader');;
        }
    }

  $replace_dash_space = view::get_option('replace_dash_space', true);
  $replace_underscore_space = view::get_option('replace_underscore_space', true);
  $display_file_extensions = true;
?>
<div id="header">
  <?php
  if (view::get_option('display_header', true)) {
    $site_name_display = Kohana::config('filebrowser.site_name');
    $logo = Kohana::config('filebrowser.site_logo_url');
    $logo = view::get_option('site_logo_url', $logo);
    if ($logo <> "") {
    	$width = Kohana::config('filebrowser.site_logo_width');
    	$width = view::get_option('site_logo_width', $width);
    	
			$height = Kohana::config('filebrowser.site_logo_height');
    	$height = view::get_option('site_logo_height', $height);
			
			if ($width <> '') { $width = " width='$width' "; }
			if ($height <> '') { $height = " height='$height' "; }
      $site_name_display = "<img $width $height src='$logo' />";
    }
  ?>
	<h1 id="logo" class="logo <?php print "".$showHide; ?>"><a href='/' ><?php echo $site_name_display ?></a></h1>
	<?php } ?>
</div>

<div id="breadcrumbtools">
  <?php $ff = $this->filebrowser->get_path(); ?>
  <?php if (view::get_option('display_breadcrumb', true)) { ?>
  <div id="breadcrumb">
    <?php if ($this->auth->logged_in()) { ?>
      <?php echo $this->auth->get_user()->name ?> browsing
    <?php } ?>

    <?php 
      $parts = explode( "/", $ff);
    ?>
    <?php if ($ff <> "" && sizeof($parts) > 0) { 
      $path = "/";
      ?>
      <?php echo Kohana::lang('filebrowser.indexof'); ?> <a href="/"><?php echo Kohana::config('filebrowser.site_domain'); ?></a>
  
      <?php 
      $count = 1;
      foreach ($parts as $key => $value): ?>
        &nbsp;/&nbsp;
        
        <?php if ($count == sizeof($parts)) { ?>
          <?php echo htmlentities(FileFolder::fix_display_name($value, $replace_dash_space, $replace_underscore_space, $display_file_extensions)) ?>
        <?php } else { ?>
          <a href="<?php echo $path.$value ?>"><?php echo htmlentities(FileFolder::fix_display_name($value, $replace_dash_space, $replace_underscore_space, $display_file_extensions)) ?></a>
        <?php }  ?>
      <?php 
        $path .=  $value . "/";
        $count ++;
      endforeach ?>
  
    <?php } else { ?>
      <?php echo Kohana::lang('filebrowser.indexof'); ?> <a href="/"><?php echo Kohana::config('filebrowser.site_domain'); ?></a>
    <?php } ?>
  </div>
  <?php } ?>
  <div id="tools">
      <?php
      if ($this->auth->logged_in()) {
          print "<a title='Logout' alt='' href='/logout'>".Kohana::lang('filebrowser.logout')."</a>";
      }
      if (view::get_option('display_send_page', true)) { ?>
      <span class="nav_sep"></span><?php
      $subject = "Link from " . $_SERVER["SERVER_NAME"];
      $body = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
      ?><script>
      <!--
      document.write('<a href="mailto:?subject=<?php print "".$subject?>&body='+location.href+'"><?php echo Kohana::lang('filebrowser.sendpage') ?></a>');
      -->
      </script>
      <?php } ?>
    <?php if (view::get_option('display_tiny_url', true)) { ?>
    <span class="nav_sep"></span><a href="javascript:void(location.href='http://tinyurl.com/create.php?url='+encodeURIComponent(location.href))">generate tiny url</a>
    <?php } ?>
    <?php if (view::get_option('display_collapse_header', true) and view::get_option('display_header', true)) { ?>
    <span class="nav_sep"></span><a id="showHideSwitch" href="javascript:showHideSwitch('logo', document.getElementById('hideText'));"><FONT id="hideText"><?php print "".$showHideLabel;?></FONT></a>
    <?php } ?>

  </div>
</div>
 
<?php if (view::get_option('display_navigation', true)) { ?>
  <?php require("prev_next.inc.php") ?>
<?php } ?>
