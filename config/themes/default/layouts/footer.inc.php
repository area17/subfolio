<footer class="footer" id="footer">

  <div class="footer__copyright">
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
  <div class="footer__logout"><?php echo Subfolio::link_to(SubfolioLanguage::get_text('logout'),'/logout'); ?></div>
  <?php } ?>
</footer>

<!-- Display only if search is activated for this account -->
<?php #if (SubfolioUser::is_logged_in()) { ?>
<div class="search" data-search data-url="http://studio.area17.com/search/services/rest/index/studio_file_index/search/field/search" data-autocomplete-url="http://studio.area17.com/search/services/rest/index/studio_file_index/autocompletion/autofilename">
  <form>
    <input type="text" name="query" data-search-input />
    <input type="hidden" name="login" value="searchadmin" />
    <input type="hidden" name="key" value="93dde3c46cdeba7c3a200ee18e8375fc" />
  </form>
  <div data-search-results >

  </div>
  <a href="#" class="icon icon__close" data-search-close></a>
</div>

<script type="text/template" data-search-template>
<article>
  Result!
</article>
</script>
<?php #} ?>