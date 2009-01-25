
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
<?php foreach ($folders as $folder) : ?>
  <tr>
    <td>
      <?php
        //different folder based on the access
        $thumbnail = view::get_view_url()."/images/i_dir.gif";
         
        if ($folder->is_restricted()) {
          $thumbnail = view::get_view_url()."/images/i_dir.gif";
          if ($folder->have_access($this->auth->get_user())) {
            $thumbnail = view::get_view_url()."/images/i_dir_unlocked.gif";
          } else {
            $thumbnail = view::get_view_url()."/images/i_dir_locked.gif";
          }
        }
      ?>
      <img src='<?php echo $thumbnail ?>' width='30' height='14' border='0' />
    </td>
    <td class="filename">
      <a href="<?php echo $this->filebrowser->get_link($folder->name); ?>"><?php echo $folder->name; ?></a>
    </td>
    <td class="filesize">
      
    </td>
    <td class="filedate">
      <?php echo format::filedate($folder->stats['mtime']); ?>
    </td>
    <td class="filekind">
      folder
    </td>
    <td class="filecomment">
      <?php echo $this->filebrowser->get_item_property($folder->name, 'comment') ?>
    </td>
  </tr>
<?php endforeach ?>

<?php foreach ($files as $file) :
  if (!$file->has_thumbnail()) :
    $kind = $this->filebrowser->get_kind($file->name);
  ?>
  <tr>
    <td>
      <img src='<?php echo view::get_view_url() ?>/images/i_<?php echo $this->filebrowser->get_kind($file->name) ?>.gif' width='30' height='14' border='0' />
    </td>
    <td class="filename">
      <?php 
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
  			case "suit" :
  			case "rtf" :
  			case "zip" :
  			  ?>
  			  <a href="/directory<?php echo $this->filebrowser->get_link($file->name); ?>"><?php echo $file->name; ?></a>
          <?php
  			  break;

  			case "net" :
          $url = $this->filebrowser->get_item_property($file->name, 'url')    ? $this->filebrowser->get_item_property($file->name, 'url') : '';
          $target = $this->filebrowser->get_item_property($file->name, 'target')    ? $this->filebrowser->get_item_property($file->name, 'target') : '_blank';
          
          if ($url <> '') { ?>
            <a target="<?php echo $target ?>" href="<?php echo $url ?>"><?php echo $file->name ?></a>
          <? }
  			  break;

  			default:
  			  ?>
  			  <a href="<?php echo $this->filebrowser->get_link($file->name); ?>"><?php echo $file->name; ?></a>
          <?php
          break;  			
	    }
      ?>
      
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
