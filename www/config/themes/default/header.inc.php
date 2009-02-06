<?php
    $showHide = "showSwitch";
    $showHideLabel = "".Kohana::lang('filebrowser.collapseheader');
    if (isset($_COOKIE['logo'])) {
        if ($_COOKIE['logo'] == "hideSwitch") {
            $showHide = "hideSwitch";
            $showHideLabel = "".Kohana::lang('filebrowser.expandheader');;
        }
    }
?>
<div id="header">
	<h1 id="logo" class="logo <?php print "".$showHide;?>"><a href='/' ><?php echo Kohana::config('filebrowser.site_name'); ?></a></div>
</div>

<div id="navigation">
  <div id="path">
    <?php 
      $ff = $this->filebrowser->get_path(); 
      $parts = explode( "/", $ff);
    ?>
    <?php if ($ff <> "" && sizeof($parts) > 0) { 
      $path = "/";
      ?>
      index of <a href="/"><?php echo Kohana::config('filebrowser.site_domain'); ?></a>
  
      <?php 
      $count = 1;
      foreach ($parts as $key => $value): ?>
        &nbsp;/&nbsp;
        
        <?php if ($count == sizeof($parts)) { ?>
          <?php echo $value ?>
        <?php } else { ?>
          <a href="<?php echo $path.$value ?>"><?php echo $value ?></a>
        <?php }  ?>
      <?php 
        $path .=  $value . "/";
        $count ++;
      endforeach ?>
  
    <?php } else { ?>
      <?php echo Kohana::lang('filebrowser.indexof'); ?> <?php echo Kohana::config('filebrowser.site_domain'); ?>
    <?php } ?>
  </div>
  <div id="pathlinks">
      <?php
      if ($this->auth->logged_in()) {
          print "<a title='Logout' alt='' href='/logout'>".Kohana::lang('filebrowser.logout')."</a> | ";
      }
  
      $subject = "Link from " . $_SERVER["SERVER_NAME"];
      $body = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
      ?>
    <script>
      <!--
      document.write('<a href="mailto:?subject=<?php print "".$subject?>&body='+location.href+'"><?php echo Kohana::lang('filebrowser.sendpage') ?></a>');
      -->
    </script>
    | <a id="showHideSwitch" href="javascript:showHideSwitch('logo', document.getElementById('hideText')); "><FONT id="hideText"><?php print "".$showHideLabel;?></FONT></a>
  </div>

  <?php if ($ff <> ""): ?>
  <div class="prev_next">
    
		<div class='fileicon parent_arrow'><a href='/<?php echo dirname($ff) ?>'><img src='<?php echo view::get_view_url() ?>/images/i_parent.gif' alt='' width='30' height='14' border='0' /></a></div>
		<div class='filename'><a href='/<?php echo dirname($ff) ?>'>Parent Directory</a></div>
    
    <?php if($this->filebrowser->is_file()): 
      $file = $this->filebrowser->get_file();
      $files = $this->filebrowser->get_parent_file_list();
			$prev = $this->filebrowser->get_prev($files, $file->name);
			$next = $this->filebrowser->get_next($files, $file->name);

			if ($prev <> "") {
				print "<a href='$prev->name'>Prev</a>";
			} else {
				print "<span class='faded'>Prev</span>";
			}
			echo "&nbsp;&nbsp;|&nbsp;&nbsp;";

			if ($next <> "") {
				print "<a href='$next->name'>Next</a>";
			} else {
				print "<span class='faded'>Next</span>";
			}
      ?>
    <?php else: 
      $folder  = basename($this->filebrowser->get_folder());
      $folders = $this->filebrowser->get_parent_folder_list();
			$prev    = $this->filebrowser->get_prev($folders, $folder);
			$next    = $this->filebrowser->get_next($folders, $folder);

			if ($prev <> "") {
				print "<a href='$prev->name'>Prev Directory</a>";
			} else {
				print "<span class='faded'>Prev Directory</span>";
			}
			echo "&nbsp;&nbsp;|&nbsp;&nbsp;";

			if ($next <> "") {
				print "<a href='$next->name'>Next Directory</a>";
			} else {
				print "<span class='faded'>Next Directory</span>";
			}
      ?>
    <?php endif ?>
  </div>
  <?php endif ?>
</div>