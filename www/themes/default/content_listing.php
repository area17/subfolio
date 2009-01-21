<ul>
<?php foreach ($folders as $folder) : ?>
  <li><a href="<?php echo $this->filebrowser->get_link($folder); ?>"><?php echo $folder; ?></a></li>
<?php endforeach ?>
</ul>


<ul>
<?php foreach ($files as $file) : ?>
  <li><a href="<?php echo $this->filebrowser->get_link($file); ?>"><?php echo $file; ?></a></li>
<?php endforeach ?>
</ul>
