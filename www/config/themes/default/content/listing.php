<?php if (sizeof($folders) + sizeof($files) > 0) { ?>
<table class="file_folder_listing">
<thead>
  <tr>
    <td>
      <img src='<?php echo view::get_view_url() ?>/images/no_icon.gif' width='30' height='14' border='0' />
    </td>
    <td class="filename">
      filename
    </td>
    <td class="filesize">
      size
    </td>
    <td class="filedate">
      date
    </td>
    <td class="filekind">
      kind
    </td>
    <td class="filecomment">
      comments
    </td>
  </tr>
</thead>

<tbody>
<?php 
$new_updated_start = strtotime("-7 days");
foreach ($folders as $folder): 
    $kind = $this->filebrowser->get_kind($folder->name);

    $url = "";
	  switch ($kind) {
			case "site" :
			  $url = "/directory".$this->filebrowser->get_link($folder->name)."/index.html";
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
        $icon_file = "i_dir";
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
      <a href="<?php echo $url ?>"><img src='<?php echo $thumbnail ?>' width='30' height='14' border='0' /></a>
    </td>
    <td class="filename">
      <a href="<?php echo $url ?>"><?php echo $folder->name ?></a>
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
<?php endforeach ?>

<?php foreach ($files as $file) :
  if (!$file->has_thumbnail()) :
    $kind = $this->filebrowser->get_kind($file->name);
    
    $new = "";
    $updated = "";

      if (false && $file->stats['ctime'] < $new_updated_start) {
          $new = "_new";
      } else if ($file->stats['mtime'] < $new_updated_start) {
          $updated = "_up";
      }

      $target = "";
      $url = "";

		  switch ($kind) {
  			case "ai" :
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
  			  $url = "/directory".$this->filebrowser->get_link($file->name);
  			  break;

  			case "pop" :
          $width    = $this->filebrowser->get_item_property($file->name, 'width')    ? $this->filebrowser->get_item_property($file->name, 'width') : 800;
          $height   = $this->filebrowser->get_item_property($file->name, 'height')   ? $this->filebrowser->get_item_property($file->name, 'height') : 600;
          $url      = $this->filebrowser->get_item_property($file->name, 'url')      ? $this->filebrowser->get_item_property($file->name, 'url') : 'http://www.area17.com';
          $name     = $this->filebrowser->get_item_property($file->name, 'name')     ? $this->filebrowser->get_item_property($file->name, 'name') : 'POPUP';
          $style    = $this->filebrowser->get_item_property($file->name, 'style')    ? $this->filebrowser->get_item_property($file->name, 'style') : 'WINDOW';

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
      <a <?php if ($target <> "") print "target='$target'" ?> href="<?php echo $url ?>"><?php echo $file->name ?></a>
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
  <p>No files present</p>
<?php } ?>