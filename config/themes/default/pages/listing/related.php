<?php if (SubfolioFiles::have_related()) : ?>

  <div id="related">
    <p><?php echo SubfolioLanguage::get_text('seealso') ?></p>
    <div class="<?php echo SubfolioTheme::get_listing_mode() ?>">

      <?php foreach ( SubfolioFiles::related() as $item) : ?>
        <a class="list__row" href='<?php echo $item['link'] ?>'>
          <?php if (SubfolioTheme::get_option('display_icons')) { ?>
            <?php if ($item['restricted']) {  ?>
            <span class="<?php if ($item['have_access']) { echo "unlocked"; } else { echo "locked"; } ?>"><!-- --></span>
            <?php } ?>
            <span class="icon" <?php if (SubfolioTheme::get_mobile_viewport()) { echo "style='background-image:url(".$item['icon_grid'].")'"; } ?>>

            <?php if (SubfolioTheme::get_listing_mode()=='list') : ?>
              <img src='<?php echo $item['icon'] ?>' width='18' height='17' />
            <?php else : ?>
              <img src='<?php echo $item['icon_grid'] ?>' width='32' height='32' />
            <?php endif; ?>

            </span>
          <?php } ?>
          <span class="filename"><?php echo $item['filename'] ?></span>
        </a>
      <?php endforeach; ?>

    </div>
  </div>

<?php endif ?>