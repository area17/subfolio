<?php if ($ff <> "") { ?>
<div id="navigation">
	<span class="parent_dir">
	    <a href='/<?php echo dirname($ff) ?>'>
			<span class='fileicon'>
				<span class="icon_download blank"><!-- --></span>
				<span class="parent_arrow">Parent Directory</span>
			</span>
			<span class='name'>Parent Directory</span>
	    </a>
    </span>
  <?php if($this->filebrowser->is_file()) {
    $file = $this->filebrowser->get_file();
    $files = $this->filebrowser->get_parent_file_list();
    
    $files = $this->filebrowser->prev_next_sort($files);
    
		$prev = $this->filebrowser->get_prev($files, $file->name);
		$next = $this->filebrowser->get_next($files, $file->name);

		if ($prev <> "") {
			print "<a href='$prev->name'>Previous</a>";
		} else {
			print "<span class='faded'>Previous</span>";
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
			print "<a href='$prev->name'>Previous Directory</a>";
		} else {
			print "<span class='faded'>Previous Directory</span>";
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