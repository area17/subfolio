/* Register keypress events on the whole document when navigation/search exists
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Helpers.keyPress = function() {

  var $body = $('body');
  var $previous = $('#previous');
  var $next = $('#next');

  // focused listing
  var $list = $('.focusable');
  var focused_index = -1;
  var last_focusable = $list.length - 1;

  // search
  var $search = $('[data-search]');

  $(document).on("keydown", function(e) {

    // no alt, ctrl or cmd keys pressed
    if(!e.altKey && !e.ctrlKey && !e.metaKey) {

      switch(e.keyCode) {
        // user pressed "left" arrow
        case 37:
          if ($previous.length) {
            var previous_url = $previous.attr("href");
            if(previous_url) _triggerHover($previous, previous_url);
          }
        break;

        // user pressed "up" arrow
        case 38:
          if($list.length) _setFocused("prev", e);
        break;
        // user pressed "right" arrow
        case 39:
          if ($next.length) {
            var next_url = $next.attr("href");
            if(next_url) _triggerHover($next, next_url);
          }
        break;
        // user pressed "down" arrow
        case 40:
          if($list.length) _setFocused("next", e);
        break;
        // user pressed "esc" down : Escape from the search or go back to parent directory
        case 27:
          if(is_search_active && $search.length) _hideSearch();
          else {
            var $parent_dir = $(".breadcrumb").find("a").last();
            if($parent_dir.length) {
              if($parent_dir.attr('href')) _triggerHover($parent_dir, $parent_dir.attr('href'));
            }
          }
        break;
        default:
          // launch search if exist!
          if($search.length) {
            if(e.keyCode >= 65 && e.keyCode <= 90 || e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105) {
              if(!is_search_active) _showSearch();
            }
          }
      }
    }
  });

  // Prev / next arrow
  function _triggerHover($el, next_url) {
    $el.addClass('hover').fadeTo(250, 1, function() {
      window.location = next_url;
    });
  }

  // Set focus state on the list items when using up and down keys
  function _setFocused(dir, e) {

    if($list.filter(':focus').length) {

      if(dir === "next") {
        focused_index++;
        if(focused_index >= $list.length) focused_index = 0;
      } else {
        focused_index--;
        if(focused_index < 0) focused_index = $list.length;
      }

      var $next_one = $list.eq(focused_index);
      if($next_one.length) $next_one.focus();

      e.preventDefault();
    } else {
      if(dir === "next") focused_index = 0;
      else focused_index = last_focusable;

      $list.eq(focused_index).focus();
    }
  }

  // search engine ----

  if($search.length) {
    // DOM
    var $search_input       = $('[data-search-input]'),
        $search_close       = $('[data-search-close]'),
        $search_results     = $('[data-search-results]'),
        $search_template    = $('[data-search-template]'),
        $search_form        = $search.find('form'),
        $search_dropdown    = $("[data-search-dropdown]");

    var klass_search_active = "search__active",
        search_data         = "",
        is_search_active    = false,
        is_search_loading   = false;
  }


  function _showSearch() {
    $body.addClass(klass_search_active);
    if($search.is(':visible')) $search_input.focus();

    _bindAutocomplete();
    _performQuery();

    is_search_active = true;

    $search_close.on('click', function(e) {
      e.preventDefault();
      _hideSearch();
    });

    $search_dropdown.on('click', 'a', function (e) {
      e.preventDefault();

      $search_input.off('keyup.keyup_ajax');
      $search_input.val($(this).text());
      _bindAutocomplete();

      $search_form.submit();
    });
  }

  function _bindAutocomplete() {
    $search_input.on('keyup.keyup_ajax', function (event) {
      _searchDelay(250)(_performAutocomplete);
    });
  }

  function _searchDelay(ms) {
    var timer = 0;
    return function(callback){
      clearTimeout (timer);
      timer = setTimeout(callback, ms);
    };
  };

  function _hideSearch() {
    $body.removeClass(klass_search_active);
    $search_input.val('');
    $search_input.off('keyup.keyup_ajax');
    $search_close.off('click');

    is_search_active = false;
  }

  function _performQuery() {

    var api_endpoint = $search_form.attr("action");
    var template = $search_template.html();

    $search_form.on('submit', function(e) {
      e.preventDefault();

      if(is_search_loading) return false;

      var data_arr = $('input', $search_form).serializeArray();
      var data = _setData(data_arr);

      is_search_loading = true;
      $search_dropdown.empty();

      var response = {"successful":true,"documents":[{"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["longchamp"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/"]},{"fieldName":"fileSystemDate","values":["20160209153313000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":1,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["00 longchamp"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/a17_internal/02_strategy/00_new_bus_temp/minyanville/"]},{"fieldName":"fileSystemDate","values":["20080927071901000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":2,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["longchamp_tumblr_08"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/longchamp/02_tumblr/03_development/working_files/"]},{"fieldName":"fileSystemDate","values":["20160128184039000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":3,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["longchamp_tumblr_09"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/longchamp/02_tumblr/03_development/working_files/"]},{"fieldName":"fileSystemDate","values":["20160208185526000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":4,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["longchamp_tumblr_07"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/longchamp/02_tumblr/03_development/working_files/"]},{"fieldName":"fileSystemDate","values":["20160125165350000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":5,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["05_Longchamp_Mag Folder"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/longchamp/03_magazine/00_internal/00_source/"]},{"fieldName":"fileSystemDate","values":["20160210034551000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":6,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["03_Longchamp_Mag Folder"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/longchamp/03_magazine/00_internal/06/"]},{"fieldName":"fileSystemDate","values":["20160202131335000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":7,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["longchamp_brand_pres_06"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/longchamp/04_presentation/00_internal/"]},{"fieldName":"fileSystemDate","values":["20160205175534000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":8,"fields":[{"fieldName":"fileType","values":["directory"]},{"fieldName":"fileSize","values":[">00000000000000004096"]},{"fieldName":"fileName","values":["longchamp_brand_pres_07 Folder"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/longchamp/04_presentation/00_internal/"]},{"fieldName":"fileSystemDate","values":["20160210144307000"]}],"snippets":[{"fieldName":"content","highlighted":false}]},{"pos":9,"fields":[{"fieldName":"fileType","values":["file"]},{"fieldName":"fileSize","values":[">00000000000000295161"]},{"fieldName":"fileName","values":["PRO_LCP-AN_Site_v01_d01.pdf"]},{"fieldName":"directory","values":["file:/var/www/studio.area17.com/directory/00_archive/01_pitch/LCP-AN/03_Proposition/"]},{"fieldName":"fileSystemDate","values":["20140617192033000"]}],"snippets":[{"fieldName":"content","values":["Hennessy, Valrhona, <b>Longchamp</b>, Louis XIII, i>TELE, Citroën, Ligue contre le cancer, Newsring). ...Il développe en PHP/...MYSQL/HTML/CSS/JS et conceptualise les applications en ERM....AREA 17 —..."],"highlighted":true}]}],"query":"(+content:longchamp) content:\"longchamp\"~2 (+fileName:longchamp^10.0) fileName:\"longchamp\"~2^10.0","rows":10,"numFound":254,"time":1}

      // $.ajax({
      //   url: api_endpoint,
      //   type: "POST",
      //   data: data,
      //   dataType: 'json'
      // }).done(function(response) {

        $search_results.empty();

        // display response here
        var documents = response.documents;
        console.log(documents);

        if(documents.length > 0) {
          $.each(documents, function() {

            var document = this;
            template_item = template;

            $.each(document.fields, function() {
              var field = this;
              var value = "–";

              if(field.values) {
                var value = field.values[0].replace("file:/var/www/", "http://").replace("/directory", "");

                // dir of file
                if(field.fieldName == "fileType") {
                  value = field.values[0] == "directory" ? "dir" : "gen";
                }

                // date
                if(field.fieldName == "fileSystemDate") {
                  var date = new Date(field.values[0].substring(0, 4), field.values[0].substring(4, 6), field.values[0].substring(6, 8));
                  value = date.toLocaleString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                }
              }

              var re = new RegExp("{{" + field.fieldName + "}}", 'g');
              template_item = template_item.replace(re, value);

            })


            $search_results.append(template_item);
          });
        }
      // }).always(function() {
         is_search_loading = false;
      // });

    });
  }

  function _setData(data_arr) {
    // misc requiered params
    data_arr.push({ "name": "start", "value": 0 });
    data_arr.push({ "name": "rows", "value": 10 });
    return $.param(data_arr);
  }

  function _performAutocomplete() {
    if(is_search_loading) return false;

    var $search_form = $search.find('form');
    var api_endpoint = $search.data("autocomplete-url");
    var data_arr = $('input', $search_form).not($search_input).serializeArray();
    data_arr.push({ "name": "prefix", "value": $search_input.val() });
    var data = _setData(data_arr);

    if(search_data != data) {
      is_search_loading = true;
      search_data = data;

      //$.ajax({
      //  url: api_endpoint,
      //  type: "GET",
      //  data: search_data,
      //  dataType: 'json'
      //}).done(function(response) {

        var response = {"successful":true,"terms":["Hello","Hello Monday.webloc","hello.erb","hello.pdf","hellonwheels.jpg"]};

        $search_dropdown.empty();
        var terms = response.terms;

        if(terms.length > 0) {
          $.each(terms, function(i) {
            $search_dropdown.append("<a href='#'>" + terms[i] + "</a>");
          });
        }

      //}).always(function() {
        is_search_loading = false;
      //});
    }
  }
}