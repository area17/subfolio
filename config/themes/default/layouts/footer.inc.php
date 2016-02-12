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
<div class="search" data-search data-autocomplete-url="http://studio.area17.com/search/services/rest/index/studio_file_index/autocompletion/autofilename">
  <form action="http://studio.area17.com/search/services/rest/index/studio_file_index/search/field/search">
    <input type="text" name="query" data-search-input />
    <div class="search__dropdown" data-search-dropdown >

    </div>
    <input type="hidden" name="login" value="searchadmin" />
    <input type="hidden" name="key" value="93dde3c46cdeba7c3a200ee18e8375fc" />
  </form>
  <div class="listing search__results"  >
  <div class="list list--list" data-search-results></div>
  </div>
  <a href="#" class="icon icon__close" data-search-close></a>
</div>

<script type="text/template" data-search-template>
  <a class="list__row list__body" href="{{directory}}/{{fileName}}">
    <span class="list__cell list__cell--filename">
      <span class="list__cell--filenameicon">
        <i class='icon icon__list_{{fileType}}'></i>
      </span>
      <span class="list__cell--filenametext">
        {{fileName}}
      </span>
    </span>
    <span class="list__cell list__cell--date">{{fileSystemDate}}</span>
    <span class="list__cell list__cell--kind"></span>
    <span class="list__cell list__cell--comment"></span>
  </a>
</script>
<?php #} ?>