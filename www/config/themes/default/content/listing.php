
<?php 
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
      <img src='<?php echo view::get_view_url() ?>/images/no_icon.gif' width='30' height='14' border='0' />
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
    $kind = $this->filebrowser->get_kind($folder->name);
    $icon_file = "i_dir";

    $url = "";
	  switch ($kind) {
			case "site" :
			  $url = "/directory".$this->filebrowser->get_link($folder->name)."/index.html";
			  $target = "_blank";
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
        $new = "";
        $updated = "";
         
        if ($folder->is_restricted()) {
          $icon_file = "i_dir";
          if ($folder->have_access($this->auth->get_user())) {
            $icon_file = "i_dir_unlocked";
          } else {
            $icon_file = "i_dir_locked";
          }
        } else {
          
          if (false && $folder->stats['ctime'] > $new_updated_start) {
              $new = "_new";
          } else if ($folder->stats['mtime'] > $new_updated_start) {
              $updated = "_up";
          }
        }
        
        
        $thumbnail = view::get_view_url()."/images/".$icon_file.$new.$updated.".gif";        
        
      ?>
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><img src='<?php echo $thumbnail ?>' width='30' height='14' border='0' /></a>
    </td>
    <td class="filename">
      <a href="<?php echo $url ?>"><?php echo $folder->get_display_name() ?></a>
    </td>
    <td class="filesize">
    </td>
    <td class="filedate">
      <?php echo format::filedate($folder->stats['mtime']); ?>
    </td>
    <td class="filekind">
        <?php echo $this->filebrowser->get_kind_display($folder->name) ?>
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
    $kind = $this->filebrowser->get_kind($file->name);
    
    $new = "";
    $updated = "";

      if (false && $file->stats['ctime'] > $new_updated_start) {
          $new = "_new";
      } else if ($file->stats['mtime'] > $new_updated_start) {
          $updated = "_up";
      }

      $target = "";
      $url = "";

		  switch ($kind) {
  			case "ai" :
  			case "csv" :
  			case "swf" :
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
  			  break;

  			case "pop" :
          $width    = $this->filebrowser->get_item_property($file->name, 'width')    ? $this->filebrowser->get_item_property($file->name, 'width') : 800;
          $height   = $this->filebrowser->get_item_property($file->name, 'height')   ? $this->filebrowser->get_item_property($file->name, 'height') : 600;
          $url      = $this->filebrowser->get_item_property($file->name, 'url')      ? $this->filebrowser->get_item_property($file->name, 'url') : 'http://www.subfolio.com';
          $name     = $this->filebrowser->get_item_property($file->name, 'name')     ? $this->filebrowser->get_item_property($file->name, 'name') : 'POPUP';
          $style    = $this->filebrowser->get_item_property($file->name, 'style')    ? $this->filebrowser->get_item_property($file->name, 'style') : 'POPSCROLL';

          $url = "javascript:pop('$url','$name',$width,$height,'$style');";
          break;

  			case "net" :
          $url = $this->filebrowser->get_item_property($file->name, 'url')    ? $this->filebrowser->get_item_property($file->name, 'url') : '';
          $target = $this->filebrowser->get_item_property($file->name, 'target')    ? $this->filebrowser->get_item_property($file->name, 'target') : '_blank';
  			  break;

  			default:
  			  $url = $this->filebrowser->get_link($file->name);
          break;  			
	    }

  ?>
  <tr>
    <td>
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><img src='<?php echo view::get_view_url() ?>/images/i_<?php echo $this->filebrowser->get_kind($file->name).$new.$updated; ?>.gif' width='30' height='14' border='0' /></a>
    </td>
    <td class="filename">
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><?php echo $file->get_display_name() ?></a>
    </td>
    <td class="filesize">
      <?php echo format::filesize($file->stats['size']); ?>
    </td>
    <td class="filedate">
      <?php echo format::filedate($file->stats['mtime']); ?>
    </td>
    <td class="filekind">
      <?php echo $this->filebrowser->get_kind_display($file->name) ?>
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