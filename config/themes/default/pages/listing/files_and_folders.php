<?php if (SubfolioFiles::have_files()) : ?>

  <div id="listing">

    <div class="<?php echo SubfolioTheme::get_listing_mode() ?>">

      <?php if (!SubfolioTheme::get_mobile_viewport() && SubfolioTheme::get_option('display_file_listing_header')) { ?>
        <div class="list__row list__header">
          <?php if (SubfolioTheme::get_option('display_icons')) { ?>
            <span class="list__cell list__cell--icon">
              <img src="<?php echo SubfolioTheme::get_view_url() ?>/images/system/no_icon.png" width='18' height='17' border='0' />
            </span>
          <?php } ?>
          <?php if (SubfolioTheme::get_option('display_name')) { ?>
            <span class="list__cell list__cell--filename"><a href="?sort=filename"><?php echo SubfolioLanguage::get_text('filename'); ?></a></span>
          <?php } ?>
          <?php if (SubfolioTheme::get_option('display_size')) { ?>
            <span class="list__cell list__cell--size"><a href="?sort=size"><?php echo SubfolioLanguage::get_text('size'); ?></a></span>
          <?php } ?>
          <?php if (SubfolioTheme::get_option('display_date')) { ?>
            <span class="list__cell list__cell--updated"></span>
            <span class="list__cell list__cell--date"><a href="?sort=date"><?php echo SubfolioLanguage::get_text('date'); ?></a></span>
          <?php } ?>
          <?php if (SubfolioTheme::get_option('display_kind')) { ?>
            <span class="list__cell list__cell--kind"><a href="?sort=kind"><?php echo SubfolioLanguage::get_text('kind'); ?></a></span>
          <?php } ?>
          <?php if (SubfolioTheme::get_option('display_comment')) { ?>
            <span class="list__cell list__cell--comment"><?php echo SubfolioLanguage::get_text('comment'); ?></span>
          <?php } ?>
        </div>
      <?php } ?>

      <?php foreach ( SubfolioFiles::files_and_folders() as $item) : ?>
        <a class="list__row <?php echo  ($item['empty'] == true) ? 'list__row--empty' : ''; ?>" target="<?php echo $item['target'] ?>" href="<?php echo $item['url'] ?>">

          <!-- ICON -->
          <?php if (SubfolioTheme::get_option('display_icons')) : ?>
            <span class="list__cell list__cell--icon" <?php if (SubfolioTheme::get_mobile_viewport()) { echo "style='background-image:url(".$item['icon_grid'].")'"; } ?>>
              <?php if ($item['new']) { ?>
                  <span class="new"><!-- --></span>
              <?php } ?>
              <?php if ($item['restricted']) { ?>
                <span class="<?php if ($item['have_access']) { echo "unlocked"; } else { echo "locked"; } ?>"><!-- --></span>
              <?php } ?>

            <?php if (SubfolioTheme::get_listing_mode()=='list') : ?>
              <img src='<?php echo $item['icon'] ?>' width='18' height='17' />
            <?php else : ?>
              <img src='<?php echo $item['icon_grid'] ?>' width='32' height='32' />
            <?php endif; ?>
            </span>
          <?php else : ?>
            <span class="list__cell list__cell--no_icon"></span>
          <?php endif; ?>

          <!-- FILENAME -->
          <?php if (SubfolioTheme::get_option('display_name')) { ?><span class="list__cell list__cell--filename"><?php echo $item['filename'] ?></span><?php } ?>

          <!-- OTHER COLUMNS -->
          <?php if (SubfolioTheme::get_option('display_size')) { ?><span class="list__cell list__cell--size"><?php echo $item['size'] ?></span><?php } ?>

          <?php if (SubfolioTheme::get_option('display_date')) { ?>
            <span class="list__cell list__cell--updated">
              <span class="updated <?php if($item['updated']) { echo "updated--new"; } ?>"></span>
            </span>
            <span class="list__cell list__cell--date"><?php echo $item['date'] ?></span>
          <?php } ?>
          <?php if (SubfolioTheme::get_option('display_kind')) { ?><span class="list__cell list__cell--kind"><?php echo $item['kind'] ?></span><?php } ?>
          <?php if (SubfolioTheme::get_option('display_comment')) { ?><span class="list__cell list__cell--comment"><?php echo $item['comment'] ?></span><?php } ?>

        </a>
      <?php endforeach; ?>

    </div>
  </div><!-- listing -->

<?php else : ?>
  <?php if (SubfolioFiles::is_empty_folder()) : ?>
    <p><?php echo SubfolioLanguage::get_text('emptyfolder') ?></p>
  <?php endif; ?>

<?php endif; ?>
