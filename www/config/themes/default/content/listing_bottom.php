<?php
$inline = $this->filebrowser->get_file_list("cut", null, true);
if (sizeof($inline) > 0) { 
  foreach($inline as $file) {
    $url = $this->filebrowser->get_item_property($file->name, 'url');
    if ($url == "") {
      $url = $this->filebrowser->get_item_property($file->name, 'directory');
    }
    $name = $this->filebrowser->get_item_property($file->name, 'name');
  ?>
<div id='related' class='clearfix'>
  <div style='padding-bottom: 5px;'>see also:<br/></div>
  <div class='clearfix list'>
    <div class='fileicon'>
      <a href='<?php echo $url ?>'><img src='<?php echo view::get_view_url() ?>/images/i_dir_cut.gif' alt='' width='30' height='14' border='0' /></a>
    </div>
    <div class='filename'>
      <a href='<?php echo $url ?>'><?php echo $name ?></a>
    </div>
    <div class='filecomment'></div>
  </div>
</div><!-- INLINE TEXT --->
<?php 
  }
} ?>

<?php if ($this->filebrowser->get_folder_property('text-bottom') <> '') { ?>
<div class="listing-bottom">
  <?php echo $this->filebrowser->get_folder_property('text-bottom') ?>
</div>
<?php } ?>

<?php 
$inline = $this->filebrowser->get_file_list("txt", "-t-bottom", true);
if (sizeof($inline) > 0) { 
  $this->filebrowser->set_displayed_content(true);
  foreach($inline as $file) {
    ?>
    <div id="bottom_inline_text" class="clearfix">
    <?php
      readfile($file->name);
    ?>
    </div>
    <?php
  }
} ?>
