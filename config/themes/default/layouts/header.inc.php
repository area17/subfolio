<?php
  $replace_dash_space = view::get_option('replace_dash_space', true);
  $replace_underscore_space = view::get_option('replace_underscore_space', true);
  $display_file_extensions = view::get_option('display_file_extensions', true);
?>
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
	$showHide = "showSwitch";
  $showHideLabel = "".Kohana::lang('filebrowser.collapseheader');
  if (isset($_COOKIE['header'])) {
      if ($_COOKIE['header'] == "hideSwitch") {
          $showHide = "hideSwitch";
          $showHideLabel = "".Kohana::lang('filebrowser.expandheader');;
      }
  }
?>
<?php if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) { ?>
<?php } else { ?>
<div id="header" class="<?php print $showHide; ?>">
	<h1 id="logo"><a href='/' ><?php echo $site_name_display ?></a></h1>	
</div>
<?php } ?>
<?php } ?>

<div id="breadcrumbtools">
  <?php $ff = $this->filebrowser->get_path(); ?>
  <?php if (view::get_option('display_breadcrumb', true)) { ?>
  <div id="breadcrumb">
    <?php if ($this->auth->logged_in()) { ?>
      <span><?php echo $this->auth->get_user()->name ?> <?php echo Kohana::lang('filebrowser.browsing'); ?></span>
    <?php } ?>

    <?php 
      $parts = explode( "/", $ff);
    ?>
    <?php if ($ff <> "" && sizeof($parts) > 0) { 
      $path = "/";
      ?>
      <span><?php echo Kohana::lang('filebrowser.indexof'); ?>&nbsp;</span><a href="/"><?php echo Kohana::config('filebrowser.site_domain'); ?></a>
  
      <?php 
      $count = 1;
      foreach ($parts as $key => $value): ?>
        <span class='slash'>&nbsp;/&nbsp;</span>
        
        <?php if ($count == sizeof($parts)) { ?>
          <span><?php echo htmlentities(FileFolder::fix_display_name($value, $replace_dash_space, $replace_underscore_space, $display_file_extensions)) ?></span>
        <?php } else { ?>
          <a href="<?php echo $path.$value ?>"><?php echo htmlentities(FileFolder::fix_display_name($value, $replace_dash_space, $replace_underscore_space, $display_file_extensions)) ?></a>
        <?php }  ?>
      <?php 
        $path .=  $value . "/";
        $count ++;
      endforeach ?>
  
    <?php } else { ?>
      <span><?php echo Kohana::lang('filebrowser.indexof'); ?>&nbsp;</span><a href="/"><?php echo Kohana::config('filebrowser.site_domain'); ?></a>
    <?php } ?>
  </div>
  <?php } ?>

  <?php if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) { ?>
  <?php } else { ?>
  <ul id="tools">


      <?php
      if ($this->auth->logged_in()) {
          print "<li><a title='Logout' alt='' href='/logout'>".Kohana::lang('filebrowser.logout')."</a></li>";
      }
      if (view::get_option('display_send_page', true)) {
      $subject = "Link from " . $_SERVER["SERVER_NAME"];
      $body = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
      ?><script>
      <!--
      document.write('<li><a href="mailto:?subject=<?php print "".$subject?>&body='+location.href+'"><?php echo Kohana::lang('filebrowser.sendpage') ?></a></li>');
      -->
      </script>
      <?php } ?>

    <?php if (view::get_option('display_tiny_url', true)) { ?>
    <li><a href="javascript:void(location.href='http://tinyurl.com/create.php?url='+encodeURIComponent(location.href))">generate tiny url</a></li>
    <?php } ?>
    <?php if (view::get_option('display_collapse_header', true) and view::get_option('display_header', true)) { ?>
	<li><a id="showHideSwitch" href="#"><?php print "".$showHideLabel;?></a></li>
    <?php } ?>

  </ul>
  <?php } ?>
</div>
 
<?php if (view::get_option('display_navigation', true)) { ?>
  <?php require("prev_next.inc.php") ?>
<?php } ?>
