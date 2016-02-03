<footer class="footer" id="footer">

  <div class="footer__copyright">
    <?php echo SubfolioTheme::subfolio_link(); ?>

    <?php $copyright = SubfolioTheme::get_site_copyright();
    if ($copyright <> '') { ?>
    <span class='copyright__text'><?php echo $copyright ?></span>
    <?php } ?>
  </div>

  <?php if (SubfolioTheme::get_option('display_updated_since')) { ?>
  <div class="footer__updatedsince">
    <span><?php echo SubfolioLanguage::get_text('updated_since'); ?></span>
    <?php echo SubfolioFiles::updated_since_link_or_span('lastweek'); ?>
    <span class="updatedsince__sep">&#8226;</span>
    <?php echo SubfolioFiles::updated_since_link_or_span('lastmonth'); ?>
    <span class="updatedsince__sep">&#8226;</span>
    <?php echo SubfolioFiles::updated_since_link_or_span('lastvisit'); ?>
  <?php } ?>
  </div>
  <?php if (SubfolioUser::is_logged_in()) { ?>
  <div class="footer__logout"><?php echo Subfolio::link_to(SubfolioLanguage::get_text('logout')." ".SubfolioUser::current_user_fullname(),'/logout'); ?></div>
  <?php } ?>
</footer>


