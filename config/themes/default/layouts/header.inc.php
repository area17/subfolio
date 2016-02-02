<header class="header">
  <?php if (SubfolioUser::is_logged_in()) { ?>
  <div class="header__logout"><?php echo Subfolio::link_to(SubfolioLanguage::get_text('logout')." ".SubfolioUser::current_user_fullname(),'/logout'); ?></div>
  <?php } ?>

  <?php if (!SubfolioTheme::get_mobile_viewport() && SubfolioTheme::get_option('display_header', true)) { ?>
  <div id="header" class="header__logo <?php if (isset($_COOKIE['header'])) echo htmlentities($_COOKIE['header']); ?>">
    <h1 id="logo"><a href='<?php print Kohana::config('filebrowser.site_root'); ?>' ><?php echo SubfolioTheme::get_site_name(); ?></a></h1>
  </div>
  <?php } ?>

<div class="header__breadcrumb" id="breadcrumbtools">
  <div class="breadcrumbtools__inner">
  <?php if (SubfolioTheme::get_option('display_breadcrumb', true)) { ?>
    <div id="breadcrumb">
      <?php if (SubfolioLanguage::get_text('indexof')<>'') { ?>
        <span><?php echo SubfolioLanguage::get_text('indexof'); ?></span>&nbsp;&nbsp;
      <?php } ?>
      <a href="<?php print Kohana::config('filebrowser.site_root'); ?>"><?php echo Subfolio::get_setting('site_domain'); ?></a>
      <?php foreach (SubfolioTheme::get_breadcrumb() as $crumb) { ?>
        <span class='slash'>&nbsp;/&nbsp;</span>
        <?php if ($crumb['url'] <> '') { ?>
          <a href="<?php echo $crumb['url'] ?>"><?php echo $crumb['name'] ?></a>
        <?php } else { ?>
          <span><?php echo $crumb['name'] ?></span>
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
