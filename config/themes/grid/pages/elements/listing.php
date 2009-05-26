
<!--****************************** INTRO TEXT ******************************-->

<?php 
$inline = $this->filebrowser->get_file_list("txt", "-t-intro", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
    ?>
    <div id="middle-text" class="standard_paragraph">
    <?php
      readfile($file->name);
    ?>
    </div>
    <?php
  }
} ?>

<?php if ($this->filebrowser->get_folder_property('text-intro') <> '') { 
  $this->filebrowser->set_displayed_content(true);
?>
<div class="middle-text">
  <p><?php echo $this->filebrowser->get_folder_property('text-intro'); ?></p>
</div>
<?php } ?>

<?php 
$gallery_files = $this->filebrowser->get_file_list("img");
$folders = $this->filebrowser->get_folder_list();
$folders = $this->filebrowser->sort($folders);

$files  = $this->filebrowser->get_file_list();
$files  = $this->filebrowser->sort($files);

// ****************************** FILE LISTING HEADER ******************************
// Shows only if there is no Gallery

$showListing = true;

if ($showListing) { ?>
<div id="listing" class="mw"> <!-- Min width for IE --> 
  <div class="layout"> <!-- Container for IE -->
  <div class="mwc"> <!-- Container for IE -->
	<ul>
		<li class="listing-header">
			<div class="listing-content">
				<span class="listing-content-left">
					<span class="listing-content-left-inner">
						<span class="icon column">
							<span class="icon_download blank"><!-- --></span>
							<img src='<?php echo view::get_view_url() ?>/images/system/no_icon.png' width='18' height='17' border='0' />
						</span>
						<span class="name column"><a href="?sort=filename">filename</a></span>
						<span class="size column"><a href="?sort=size">size</a></span>
					</span>
				</span>
				<span class="listing-content-right">
					<span class="listing-content-right-inner">
						<span class="datekind">
							<span class="date"><a href="?sort=date">date</a></span>
							<span class="kind"><a href="?sort=kind">kind</a></span>
						</span>
						<span class="comment"><!-- --></span>
					</span>
				</span>
			</div>
		</li>
				
<!--****************************** FOLDERS ******************************-->
<!-- Sites, pages, numbers and keynote documents (who uses folders) -->

<?php 
$new_updated_start = $this->filebrowser->get_updated_since_time();
foreach ($folders as $folder): 

    if (!$this->filebrowser->is_feature($folder->name)) {
    $target = "";
    $folder_kind = $this->filekind->get_kind_by_file($folder->name);
    $kind = isset($folder_kind['kind']) ? $folder_kind['kind'] : '';
    $icon_file = "i_dir";

    $kind_display = isset($folder_kind['display']) ? $folder_kind['display'] : '';
    $url = "";
    $display = $folder->get_display_name();
	  switch ($kind) {
			case "site" :
			  	$url = "/directory".$this->filebrowser->get_link($folder->name)."/index.html";
			  	$target = "_blank";
		        $display = format::filename($folder->get_display_name(), false);
		        break;

			case "pages" :
  			  	$url = "/directory".$this->filebrowser->get_link($folder->name);
  			  	break;

			case "numbers" :
  			  	$url = "/directory".$this->filebrowser->get_link($folder->name);
  			  	break;

			case "key" :
				$url = "/directory".$this->filebrowser->get_link($folder->name);
				break;
        
			default:
          		$url = "".$this->filebrowser->get_link($folder->name);
        		break;  		
    }	
?>
		<li>
			<a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>">
				<div class="listing-content">
					<span class="listing-content-left">
						<span class="listing-content-left-inner">
							<span class="icon column">
						      <?php
						        //different folder based on the access

						        $restricted = false;
						        $have_access = false;
						        $new = false;
						        $updated = false;

						        if ($folder->is_restricted()) {
						          $restricted = true;
						          if ($folder->have_access($this->auth->get_user())) {
						            $have_access = true;
						          } else {
						            $have_access = false;
						          }
						        }
						
						        if (false && $folder->stats['ctime'] > $new_updated_start) {
					              $new = true;
					          } else if ($folder->stats['mtime'] > $new_updated_start) {
					              $updated = true;
					          }

						        $folder_kind = $this->filekind->get_kind_by_extension("dir");
						        $icon_file = $this->filekind->get_icon_by_file($folder_kind, $new, $updated, $restricted, $have_access);

						        $icon = view::get_view_url()."/images/icons/".$icon_file.".png";        
						      ?>
										<?php	if ($updated) { ?>
						      		<span class="updated"><!-- --></span>
										<?php	} ?>
										<?php	if ($new) { ?>
						      		<span class="new"><!-- --></span>
										<?php	} ?>
										<?php	if ($restricted) { ?>
											<span class="<?php if ($have_access) { echo "unlocked"; } else { echo "locked"; } ?>"><!-- --></span>
										<?php	} ?>
						      	
						      	<span class="icon_download blank"><!-- --></span>
								<img src='<?php echo "".$icon ?>' />
							</span>
							<span class="filename column"><?php echo $display ?></span>
							<span class="size column">&mdash;</span>
						</span>
					</span>
					<span class="listing-content-right">
						<span class="listing-content-right-inner">
							<span class="datekind">
								<span class="date"><?php echo format::filedate($folder->stats['mtime']); ?></span>
								<span class="kind"><?php echo $kind_display ?></span>
							</span>
							<span class="comment"><?php echo $this->filebrowser->get_item_property($folder->name, 'comment') ?></span>
						</span>
					</span>
				</div>
			</a>
		</li>


<?php 
  }
endforeach ?>

<!--****************************** FILES ******************************-->

<?php foreach ($files as $file) :
  if (!$file->has_thumbnail()) :
      $file_kind = $this->filekind->get_kind_by_file($file->name);
      
      if (isset($file_kind['kind'])) {
        $kind = $file_kind['kind'];
      } else {
        $kind = "";
      }
      
      $kind_display = isset($file_kind['display']) ? $file_kind['display'] : '';
      
      $icon_file = "";
      $new = false;
      $updated = false;

      if (false && $file->stats['ctime'] > $new_updated_start) {
          $new = true;
      } else if ($file->stats['mtime'] > $new_updated_start) {
          $updated = false;
      }

      $icon_file = $this->filekind->get_icon_by_file($file_kind, $new, $updated);
      $icon = view::get_view_url()."/images/icons/".$icon_file.".png";   

      $target = "";
      $url = "";
      $display = "";

		  switch ($kind) {
  			case "ai" :
  			case "csv" :
  			case "tif" :
  			case "xml" :
  			case "merlin" :
  			case "eps" :
  			case "gen" :
  			case "bmp" :
  			case "psd" :
  			case "tif" :
  			case "xls" :
  			case "ppt" :
  			case "doc" :
  			case "fnt" :
  			case "suit":
  			case "rtf" :
  			case "zip" :

  			case "pages" :
  			case "key" :
  			case "numbers" :
  			  $url = "/directory".$this->filebrowser->get_link($file->name);
  			  $display = $file->get_display_name();
  			  break;

  			case "pop" :
	          $width    = $this->filebrowser->get_item_property($file->name, 'width')    ? $this->filebrowser->get_item_property($file->name, 'width') : 800;
	          $height   = $this->filebrowser->get_item_property($file->name, 'height')   ? $this->filebrowser->get_item_property($file->name, 'height') : 600;
	          $url      = $this->filebrowser->get_item_property($file->name, 'url')      ? $this->filebrowser->get_item_property($file->name, 'url') : 'http://www.subfolio.com';
	          $name     = $this->filebrowser->get_item_property($file->name, 'name')     ? $this->filebrowser->get_item_property($file->name, 'name') : 'POPUP';
	          $style    = $this->filebrowser->get_item_property($file->name, 'style')    ? $this->filebrowser->get_item_property($file->name, 'style') : 'POPSCROLL';
	
	          $url = "javascript:pop('$url','$name',$width,$height,'$style');";
	  			  $display = format::filename($file->get_display_name(), false);
	          break;

  			case "link" :
	          $url = $this->filebrowser->get_item_property($file->name, 'url')    ? $this->filebrowser->get_item_property($file->name, 'url') : '';
	          $target = $this->filebrowser->get_item_property($file->name, 'target')    ? $this->filebrowser->get_item_property($file->name, 'target') : '_blank';
  			  $display = format::filename($file->get_display_name(), false);
  			  break;

  			default:
  			  $url = $this->filebrowser->get_link($file->name);
  			  $display = $file->get_display_name();
          	break;  			
	    }

  ?>
		<li>
			<a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>">
				<div class="listing-content">
					<span class="listing-content-left">
						<span class="listing-content-left-inner">
							<span class="icon column">
								
								<?php	if ($updated) { ?>
				      		<span class="updated"><!-- --></span>
								<?php	} ?>
								<?php	if ($new) { ?>
				      		<span class="new"><!-- --></span>
								<?php	} ?>
								
								<span class="icon_download"><!-- --></span>
								<img src='<?php echo $icon; ?>' />
							</span>
							<span class="filename column"><?php echo $display ?></span>
							<span class="size column"><?php echo format::filesize($file->stats['size']); ?></span>
						</span>
					</span>
					<span class="listing-content-right">
						<span class="listing-content-right-inner">
							<span class="datekind">
								<span class="date"><?php echo format::filedate($file->stats['mtime']); ?></span>
								<span class="kind"><?php echo $kind_display ?></span>
							</span>
							<span class="comment"><?php echo $this->filebrowser->get_item_property ($file->name, 'comment') ?></span>
						</span>
					</span>
				</div>
			</a>
		</li>

  <?php endif ?>
<?php endforeach ?>
    </ul>
  </div>
  </div>
</div >
<?php } else { ?>
  <?php if (sizeof($gallery_files) < 1 && !$this->filebrowser->get_displayed_content()) { ?>
  <p>No files present</p>
  <?php } ?>
<?php } ?>