<?php if (SubfolioFiles::have_gallery_images()) : ?>

  <div id="gallery" >
    <ul>
      <?php foreach ( SubfolioFiles::gallery_images() as $image) : ?>

        <li>
          <a href="<?php echo $image['link']; ?>">
            <div class="<?php echo $image['class'] ?>" style="max-height:<?php echo $image['container_height']."px"; ?>" >
              <div class="gallery__inner">
              <img width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" src="<?php echo $image['url'] ?>" style="max-height:<?php echo $image['container_height']."px"; ?>" />
              </div>
            </div>
            <?php if (SubfolioTheme::get_option('display_file_names_in_gallery')) { ?>
              <p><?php echo $image['filename'] ?></p>
            <?php } ?>
          </a>
        </li>

      <?php endforeach; ?>
    </ul>
  </div><!-- gallery -->

<?php endif ?>