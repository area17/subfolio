<?php if (SubfolioFiles::have_gallery_images()) : ?>

  <div class="gallery gallery--<?php echo SubfolioTheme::get_listing_mode() ?>" >
  <?php if(SubfolioTheme::get_listing_mode()=='masonry') { ?>
    <ul data-behavior="masonry">
  <?php } else { ?>
    <ul>
  <?php } ?>
      <?php foreach ( SubfolioFiles::gallery_images() as $image) : ?>
        <li>
          <a href="<?php echo $image['link']; ?>"  class="focusable">
            <div class="<?php echo $image['class'] ?>" style="<?php if(SubfolioTheme::get_listing_mode()!='masonry') { ?>max-height:<?php echo $image['container_height']."px"; ?><?php } ?>" >
              <div class="gallery__inner">
              <img width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" src="<?php echo $image['url'] ?>" <?php if(SubfolioTheme::get_listing_mode()!='masonry') { ?>style="max-height:<?php echo $image['container_height']."px"; ?>"<?php } ?> />
              </div>
            </div>
            <?php if (SubfolioTheme::get_option('display_file_names_in_gallery') && SubfolioTheme::get_listing_mode() != 'masonry') { ?>
              <p><?php echo $image['filename'] ?></p>
            <?php } ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div><!-- gallery -->

<?php endif ?>