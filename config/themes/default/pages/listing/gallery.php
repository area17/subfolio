<?php if (SubfolioFiles::have_gallery_images()) : ?>

  <div class="gallery gallery--<?php echo SubfolioTheme::get_listing_mode() ?>" >
  <?php if(SubfolioTheme::get_listing_mode()=='masonry') { ?>
    <ul data-behavior="masonry">
  <?php } else { ?>
    <ul>
  <?php } ?>
      <?php foreach ( SubfolioFiles::gallery_images(SubfolioTheme::get_listing_mode()) as $image) : ?>
        <li>
          <a href="<?php echo $image['link']; ?>"  class="focusable">
            <div class="<?php echo $image['class'] ?>" style="<?php if(SubfolioTheme::get_listing_mode()!='masonry') { ?>max-height:<?php echo $image['container_height']."px"; ?><?php } ?>" >
              <div class="gallery__inner">
              <img width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" src="<?php echo $image['url'] ?>" <?php if(SubfolioTheme::get_listing_mode()!='masonry') { ?>style="max-height:<?php echo $image['container_height']."px"; ?>; <?php if($image['shadow']) { ?>box-shadow:0 0 3px rgba(0,0,0, .15);<?php } ?><?php if($image['browser']) { ?>box-shadow:0 -3px 0 #dedede, 0 0 3px rgba(0,0,0, .15);<?php } ?>"<?php } else { ?>style="<?php if($image['shadow']) { ?>box-shadow:0 0 3px rgba(0,0,0, .15);<?php } ?><?php if($image['browser']) { ?>box-shadow:0 -3px 0 #dedede, 0 0 3px rgba(0,0,0, .15);<?php } ?>"<?php } ?> />
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