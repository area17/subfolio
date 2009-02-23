<?php if ($ff <> "") { ?>
<div class="prev_next">
  
	<div class='fileicon parent_arrow'><a href='/<?php echo dirname($ff) ?>'><img src='<?php echo view::get_view_url() ?>/images/i_parent.gif' alt='' width='30' height='14' border='0' /></a></div>
	<div class='filename'><a href='/<?php echo dirname($ff) ?>'>Parent Directory</a></div>
  
  <?php if($this->filebrowser->is_file()) {
    $file = $this->filebrowser->get_file();
    $files = $this->filebrowser->get_parent_file_list();
    
    $files = $this->filebrowser->prev_next_sort($files);
    
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
  <?php } else { 
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
  <?php } ?>
</div>
<?php } ?>