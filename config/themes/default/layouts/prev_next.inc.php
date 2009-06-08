<?php if ($ff <> "") { ?>
<div id="navigation">
	<span class="parent_dir">
	  <?php 
    	$parent_link = urlencode(dirname($ff));
      $parent_link = str_replace('%2F', '/', $parent_link);
	  ?>
    <a href='/<?php echo $parent_link ?>'>
		<span class='fileicon'>
			<!-- span class="icon_download blank"></span> -->
			<span class="parent_arrow">Parent Directory</span>
		</span>
		<span class='name'>Parent Directory</span>
    </a>
   </span>
	<span class="prev_next">
		<?php if($this->filebrowser->is_file()) {
	    $file = $this->filebrowser->get_file();
	    $files = $this->filebrowser->get_parent_file_list();

	    $files = $this->filebrowser->prev_next_sort($files);

			$prev = $this->filebrowser->get_prev($files, $file->name);
			$next = $this->filebrowser->get_next($files, $file->name);

			if ($prev <> "") {
      	$link = urlencode($prev->name);
        $link = str_replace('%2F', '/', $link);
				print "<a href='$link'>Previous</a>";
			} else {
				print "<span class='faded'>Previous</span>";
			}
			echo "<span class='nav_sep'></span>";

			if ($next <> "") {
      	$link = urlencode($next->name);
        $link = str_replace('%2F', '/', $link);
				print "<a href='$link'>Next</a>";
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
      	$link = urlencode($prev->name);
        $link = str_replace('%2F', '/', $link);

				print "<a href='$link'>Previous Directory</a>";
			} else {
				print "<span class='faded'>Previous Directory</span>";
			}
			echo "<span class='nav_sep'></span>";

			if ($next <> "") {
      	$link = urlencode($next->name);
        $link = str_replace('%2F', '/', $link);
				print "<a href='$link'>Next Directory</a>";
			} else {
				print "<span class='faded'>Next Directory</span>";
			}
	    ?>
	  <?php } ?>
	</span>
  
</div>
<?php } ?>