<header class="header">

  <div id="header" class="header__logo <?php if (isset($_COOKIE['header'])) echo htmlentities($_COOKIE['header']); ?>">
    <?php if (SubfolioUser::is_logged_in()) { ?>
    <div class="header__logout"><?php echo Subfolio::link_to(SubfolioLanguage::get_text('logout')." ".SubfolioUser::current_user_fullname(),'/logout'); ?></div>
    <?php } ?>

    <?php if (SubfolioTheme::get_option('display_header', true)) { ?>
    <h1 id="logo"><a href='<?php print Kohana::config('filebrowser.site_root'); ?>' ><?php echo SubfolioTheme::get_site_name(); ?></a></h1>
    <?php } ?>
  </div>

  <div class="header__breadcrumb">
    <?php if (SubfolioTheme::get_option('display_breadcrumb', true)) { ?>
      <div class="breadcrumb">
        <?php if (SubfolioLanguage::get_text('indexof')<>'') { ?>
          <span class="breadcrumb__index"><?php echo SubfolioLanguage::get_text('indexof'); ?>&nbsp;&nbsp;</span>
        <?php } ?>
        <a class="breadcrumb__root" href="<?php print Kohana::config('filebrowser.site_root'); ?>"><?php echo Subfolio::get_setting('site_domain'); ?></a>
        <?php foreach (SubfolioTheme::get_breadcrumb() as $crumb) { ?>
          <span class='breadcrumb__slash'>&nbsp;/&nbsp;</span>
          <?php if ($crumb['url'] <> '') { ?>
            <a class="breadcrumb__folder" href="<?php echo $crumb['url'] ?>"><?php echo $crumb['name'] ?></a>
          <?php } else { ?>
            <span class="breadcrumb__current"><?php echo $crumb['name'] ?> <i class="icon icon__dropdown_arrow"></i></span>
          <?php }  ?>
        <?php } ?>
      </div>
    <?php } ?>


    <?php if (SubfolioTheme::get_option('display_navigation')) { ?>
      <?php require("prev_next.inc.php") ?>
    <?php } ?>
  </div>

<script>
$(document).ready(function(){
  expand_header_label = "<?php echo SubfolioLanguage::get_text('expandheader'); ?>";
  collapse_header_label = "<?php echo SubfolioLanguage::get_text('collapseheader'); ?>";
});
</script>

  <?php if (SubfolioTheme::get_option('display_collapse_header') && SubfolioTheme::get_option('display_header', true)) {
    echo SubfolioTheme::get_collapse_header_button('div');
  } ?>
</header>
