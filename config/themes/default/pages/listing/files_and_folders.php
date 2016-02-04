<?php if (SubfolioFiles::have_files()) : ?>

  <div id="listing">

    <div class="<?php echo SubfolioTheme::get_listing_mode() ?>">

      <?php if (SubfolioTheme::get_option('display_file_listing_header') && SubfolioTheme::get_listing_mode()=='list') { ?>
        <div class="list__row list__header">
          <?php if (SubfolioTheme::get_option('display_icons')) { ?>
            <span class="list__cell list__cell--icon">
              —
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
        <a class="<?php echo SubfolioTheme::get_listing_mode() ?>__row <?php echo SubfolioTheme::get_listing_mode() ?>__body <?php echo  ($item['empty'] == true) ? 'list__row--empty' : ''; ?>" target="<?php echo $item['target'] ?>" href="<?php echo $item['url'] ?>">

          <!-- ICON -->
          <?php if (SubfolioTheme::get_option('display_icons')) : ?>
            <span class="list__cell list__cell--icon">
              <?php $type = SubfolioTheme::get_listing_mode()=='list' ? $item['icon'] : $item['icon_grid']; ?>
              <?php if ($item['restricted']) { ?>
                <i class="icon icon__<?php echo $type ?>_<?php if ($item['have_access']) { echo "shared"; } else { echo "protected"; } ?>"></i>
              <?php } else { ?>
                <i class='icon icon__<?php echo $type ?>'></i>
              <?php } ?>
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
              <?php if ($item['new']) { ?>
              <span class="updated updated--new"></span>
              <?php } else { ?>
              <span class="updated <?php if($item['updated']) { echo "updated--new"; } ?>"></span>
              <?php } ?>
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
