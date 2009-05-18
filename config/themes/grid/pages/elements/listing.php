<?php 
$inline = $this->filebrowser->get_file_list("txt", "-t-intro", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
    ?>
    <div id="top_inline_text" class="clearfix">
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
<div class="top_inline_text">
  <p><?php echo $this->filebrowser->get_folder_property('text-intro'); ?></p>
</div>
<?php } ?>

<?php 
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

if ($showListing) { ?>
<table class="file_folder_listing">
<thead>
  <tr>
    <td>
      <img src='<?php echo view::get_view_url() ?>/images/icons/no_icon.gif' width='30' height='14' border='0' />
    </td>
    <td class="filename">
      <a href="?sort=filename">filename</a>
    </td>
    <td class="filesize">
      <a href="?sort=size">size</a>
    </td>
    <td class="filedate">
      <a href="?sort=date">date</a>
    </td>
    <td class="filekind">
      <a href="?sort=kind">kind</a>
    </td>
    <td class="filecomment">
      comment
    </td>
  </tr>
</thead>

<tbody>
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
          $icon_file = "i_pages";
  			  break;

			case "numbers" :
  			  $url = "/directory".$this->filebrowser->get_link($folder->name);
          $icon_file = "i_numbers";
  			  break;

			case "key" :
  			  $url = "/directory".$this->filebrowser->get_link($folder->name);
          $icon_file = "i_key";
  			  break;
        
			default:
          $url = "".$this->filebrowser->get_link($folder->name);
        break;  		
    }	
?>
  <tr>
    <td>
      <?php
        //different folder based on the access

        $icon_file = "";
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
        } else {
          if (false && $folder->stats['ctime'] > $new_updated_start) {
              $new = true;
          } else if ($folder->stats['mtime'] > $new_updated_start) {
              $updated = true;
          }
        }
        $folder_kind = $this->filekind->get_kind_by_extension("dir");
        $icon_file = $this->filekind->get_icon_by_file($folder_kind, $new, $updated, $restricted, $have_access);
        
        $icon = view::get_view_url()."/images/icons/".$icon_file.".gif";        
      ?>
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><img src='<?php echo "".$icon ?>' width='30' height='14' border='0' /></a>
    </td>
    <td class="filename">
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><?php echo $display ?></a>
    </td>
    <td class="filesize">
    </td>
    <td class="filedate">
      <?php echo format::filedate($folder->stats['mtime']); ?>
    </td>
    <td class="filekind">
        <?php echo $kind_display ?>
    </td>
    <td class="filecomment">
      <?php echo $this->filebrowser->get_item_property($folder->name, 'comment') ?>
    </td>
  </tr>
<?php 
  }
endforeach ?>

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
      $icon = view::get_view_url()."/images/icons/".$icon_file.".gif";   

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
  <tr>
    <td>
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><img src='<?php echo $icon; ?>' width='30' height='14' border='0' /></a>
    </td>
    <td class="filename">
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><?php echo $display ?></a>
    </td>
    <td class="filesize">
      <?php echo format::filesize($file->stats['size']); ?>
    </td>
    <td class="filedate">
      <?php echo format::filedate($file->stats['mtime']); ?>
    </td>
    <td class="filekind">
      <?php echo $kind_display ?>
    </td>
    <td class="filecomment">
      <?php echo $this->filebrowser->get_item_property ($file->name, 'comment') ?>
    </td>
  </tr>
  <?php endif ?>
<?php endforeach ?>
</tbody>
</table>
<?php } else { ?>
  <?php if (sizeof($gallery_files) < 1 && !$this->filebrowser->get_displayed_content()) { ?>
  <p>No files present</p>
  <?php } ?>
<?php } ?>