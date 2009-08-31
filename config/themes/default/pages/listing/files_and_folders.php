<?php 
$listing_mode = Kohana::config('filebrowser.listing_mode');
$listing_mode = view::get_option('listing_mode', $listing_mode);
$listing_mode = $this->filebrowser->get_folder_property('listing_mode', $listing_mode); 

$replace_dash_space = view::get_option('replace_dash_space', true);  
$replace_underscore_space = view::get_option('replace_underscore_space', true);
$display_file_extensions = view::get_option('display_file_extensions', true);

$gallery_files = $this->filebrowser->get_file_list("img");
$folders = $this->filebrowser->get_folder_list();
$folders = $this->filebrowser->sort($folders);

$files  = $this->filebrowser->get_file_list();
$files  = $this->filebrowser->sort($files);


$gallery_files = $this->filebrowser->get_file_list("img");
$folders = $this->filebrowser->get_folder_list();
$folders = $this->filebrowser->sort($folders);

$files  = $this->filebrowser->get_file_list();
$files  = $this->filebrowser->sort($files);

$showListing = true;

if (sizeof($folders) > 0) {
  $showListing = true;
} else {
  if (sizeof($files) > sizeof($gallery_files)) {
    $showListing = true;
  } else {
    $showListing = false;
  }
}

if ($showListing) { 
	
// ****************************** FILE LISTING HEADER ******************************

?>	
<div id="listing">
<ul class="<?php echo $listing_mode ?>">

	<?php $display_listing_header = view::get_option('display_file_listing_header', true);
	if ($display_listing_header) { ?>
	<li class="listing-header">
		<span class="icon">
			<img src='/config/themes/default/images/system/no_icon.png' width='18' height='17' border='0' />
		</span>
		<span class="filename"><a href="?sort=filename"><?php echo Kohana::lang('filebrowser.filename'); ?></a></span>
		<span class="size"><a href="?sort=size"><?php echo Kohana::lang('filebrowser.size'); ?></a></span>
		<span class="date"><a href="?sort=date"><?php echo Kohana::lang('filebrowser.date'); ?></a></span>
		<span class="kind"><a href="?sort=kind"><?php echo Kohana::lang('filebrowser.kind'); ?></a></span>
		<span class="comment"><?php echo Kohana::lang('filebrowser.comment'); ?></span>
	</li>
	<?php } ?>
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
    $display = $folder->get_display_name($replace_dash_space, $replace_underscore_space, $display_file_extensions);
	  switch ($kind) {
			case "site" :
			  		$url = "/directory".$this->filebrowser->get_link($folder->name)."/index.html";
			  		$target = "_blank";
		        $display = format::filename($folder->get_display_name($replace_dash_space, $replace_underscore_space, $display_file_extensions), false);
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
				<span class="icon">
			      <?php
			        //different folder based on the access

			        $restricted = false;
			        $have_access = false;
			        $new = false;
			        $updated = false;
							
			        if ($folder->contains_access_file()) {
			         	$restricted = true;
			          	if ($folder->have_access($this->auth->get_user())) {
			            	$have_access = true;
			          	} else {
			            	$have_access = false;
			          	}
			        }

					if (!$restricted || $have_access) {
				        if (false && $folder->stats['ctime'] > $new_updated_start) {
			            	$new = true;
			          } else if ($folder->stats['mtime'] > $new_updated_start) {
			        		$updated = true;
			          }
		         	}

              		if ($kind == "site") {
			        	$folder_kind = $this->filekind->get_kind_by_extension("site");
			        } else {
			        	$folder_kind = $this->filekind->get_kind_by_extension("dir");
			        }

			        $icon_file = $this->filekind->get_icon_by_file($folder_kind);
					$listing_mode = $this->filebrowser->get_folder_property('listing_mode', $listing_mode);
					
					// to be confirmed
					if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) {
						$listing_mode = 'grid';
					}
					
			        $icon = view::get_view_url()."/images/icons/".$listing_mode."/".$icon_file.".png";        
			      ?>
					<?php if ($updated) { ?>
			      		<span class="updated"><!-- --></span>
					<?php } ?>
					<?php if ($new) { ?>
			      	<span class="new"><!-- --></span>
					<?php } ?>
					<?php if ($restricted) { ?>
						<span class="<?php if ($have_access) { echo "unlocked"; } else { echo "locked"; } ?>"><!-- --></span>
					<?php	} ?>
			      	<!-- <span class="icon_download blank"></span> -->
					<img src='<?php echo "".$icon ?>' />
				</span>
				<span class="filename"><?php echo $display ?></span>
				<span class="size">&mdash;</span>
				<span class="date"><?php echo format::filedate($folder->stats['mtime']); ?></span>
				<span class="kind"><?php echo $kind_display ?></span>
				<span class="comment"><?php echo format::get_rendered_text($this->filebrowser->get_item_property($folder->name, 'comment')) ?></span>
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

      if ($kind == "img" && !$file->needs_thumbnail()) {
        // don't show listing for image smaller than thumbnail;
        continue;
      }
      $kind_display = isset($file_kind['display']) ? $file_kind['display'] : '';
      
      $icon_file = "";
      $new = false;
      $updated = false;
				
      if (false && $file->stats['ctime'] > $new_updated_start) {
          $new = true;
      } else if ($file->stats['mtime'] > $new_updated_start) {
          $updated = true;
      }

      $icon_file = $this->filekind->get_icon_by_file($file_kind);
	  $listing_mode = $this->filebrowser->get_folder_property('listing_mode', $listing_mode);
      
   	  // to be confirmed
	  if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) {
		  $listing_mode = 'grid';
	  }
	
	  $icon = view::get_view_url()."/images/icons/".$listing_mode."/".$icon_file.".png";

      $target = "";
      $url = "";
      $display = "";

		  switch ($kind) {

  			case "pop" :
	        $width    = $this->filebrowser->get_item_property($file->name, 'width')    ? $this->filebrowser->get_item_property($file->name, 'width') : 800;
	        $height   = $this->filebrowser->get_item_property($file->name, 'height')   ? $this->filebrowser->get_item_property($file->name, 'height') : 600;
	        $url      = $this->filebrowser->get_item_property($file->name, 'url')      ? $this->filebrowser->get_item_property($file->name, 'url') : 'http://www.subfolio.com';
	        $name     = $this->filebrowser->get_item_property($file->name, 'name')     ? $this->filebrowser->get_item_property($file->name, 'name') : 'POPUP';
	        $style    = $this->filebrowser->get_item_property($file->name, 'style')    ? $this->filebrowser->get_item_property($file->name, 'style') : 'POPSCROLL';

	        $url = "javascript:pop('$url','$name',$width,$height,'$style');";
				  $display = format::filename($file->get_display_name($replace_dash_space, $replace_underscore_space, $display_file_extensions), false);
	        break;

  			case "link" :
	        $url = $this->filebrowser->get_item_property($file->name, 'url')    ? $this->filebrowser->get_item_property($file->name, 'url') : '';
	        $target = $this->filebrowser->get_item_property($file->name, 'target')    ? $this->filebrowser->get_item_property($file->name, 'target') : '_blank';
  			  $display = format::filename($file->get_display_name($replace_dash_space, $replace_underscore_space, $display_file_extensions), false);
  			  break;

  			default:
  			  $url = $this->filebrowser->get_link($file->name);
  			  $display = $file->get_display_name($replace_dash_space, $replace_underscore_space, $display_file_extensions);
          break;  			
	    }

  ?>
		<li>
			<a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>">
				<span class="icon">
					<?php	if ($updated) { ?>
						<span class="updated"><!-- --></span>
					<?php	} ?>
					<?php	if ($new) { ?>
				    	<span class="new"><!-- --></span>
					<?php	} ?>
					<img src='<?php echo $icon; ?>' />
				</span>
				<span class="filename"><?php echo $display ?></span>
				<span class="size"><?php echo format::filesize($file->stats['size']); ?></span>
				<span class="date"><?php echo format::filedate($file->stats['mtime']); ?></span>
				<span class="kind"><?php echo $kind_display ?></span>
				<span class="comment"><?php echo format::get_rendered_text($this->filebrowser->get_item_property ($file->name, 'comment')) ?></span>
			</a>
		</li>

  <?php endif ?>
<?php endforeach ?>
</ul>
</div>
<?php } else { ?>
  <?php if (sizeof($gallery_files) < 1 && !$this->filebrowser->get_displayed_content()) { ?>
  <p>This folder is empty</p>
  <?php } ?>
<?php } ?>