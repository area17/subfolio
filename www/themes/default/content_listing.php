<table class="file_folder_listing">
<thead>
  <tr>
    <td>
      <img src='/themes/default/images/no_icon.gif' width='30' height='14' border='0' />
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
      <img src='/themes/default/images/i_dir.gif' width='30' height='14' border='0' />
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
    </td>
  </tr>
<?php endforeach ?>

<?php foreach ($files as $file) : ?>

  <tr>
    <td>
      <img src='/themes/default/images/i_<?php echo $this->filebrowser->get_kind($file->name) ?>.gif' width='30' height='14' border='0' />
    </td>
    <td class="filename">
      <a href="<?php echo $this->filebrowser->get_link($file->name); ?>"><?php echo $file->name; ?></a>
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
    </td>
  </tr>
<?php endforeach ?>
</tbody>
</table>
