<footer id="footer">

  <div class="copyright">
  <?php echo SubfolioTheme::subfolio_link(); ?>

  <?php $copyright = SubfolioTheme::get_site_copyright();
  if ($copyright <> '') { ?>
  <div class='copyright__text'><?php echo $copyright ?></span>
  <?php } ?>
  </div>

  <?php if (!SubfolioTheme::get_mobile_viewport() && SubfolioTheme::get_option('display_updated_since')) { ?>
  <div class="updatedsince">
    <span><?php echo SubfolioLanguage::get_text('updated_since'); ?></span>
    <?php echo SubfolioFiles::updated_since_link_or_span('lastweek'); ?>
    <span class="updatedsince__sep">&#8226;</span>
    <?php echo SubfolioFiles::updated_since_link_or_span('lastmonth'); ?>
    <span class="updatedsince__sep">&#8226;</span>
    <?php echo SubfolioFiles::updated_since_link_or_span('lastvisit'); ?>
  <?php } ?>
  </div>
</footer>


