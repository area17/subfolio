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

  if($search.length) {
    var $search_input       = $('[data-search-input]');
    var $search_close       = $('[data-search-close]');
    var $search_results     = $('[data-search-results]');
    var $search_template    = $('[data-search-template]');
    var klass_search_active = "search__active";
    var search_data         = "";
    var is_search_active    = false;
    var is_search_loading   = false;
  }

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



  function _showSearch() {
    $body.addClass(klass_search_active);
    if($search.is(':visible')) $search_input.focus();

    $search_input.on('keyup.keyup_ajax', function (event) {
      _searchDelay(250)(_performAutocomplete);
    });
    _performQuery();

    is_search_active = true;

    $search_close.on('click', function(e) {
      e.preventDefault();
      _hideSearch();
    });

    _updateQueryField();
  }

  function _updateQueryField() {
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
    var $search_form = $search.find('form');
    var api_endpoint = $search_form.attr("action");
    var template = $search_template.html();

    $search_form.on('submit', function(e) {
      e.preventDefault();

      if(is_search_loading) return false;

      var data_arr = $('input', $search_form).serializeArray();
      var data = _setData(data_arr);

      is_search_loading = true;

      $.ajax({
        url: api_endpoint,
        type: "POST",
        data: data,
        dataType: 'json'
      }).done(function(response) {
        console.log(response);
        $search_results.empty();

        // display response here
        if(response.documents.length > 0) {
          response.documents.each(function() {
            $search_results.append(template);
          });
        }
      }).always(function() {
        is_search_loading = false;
      });

    });
  }

  function _setData(data_arr) {
    // misc requiered params
    data_arr.push({ "name": "start", "value": 0 });
    data_arr.push({ "name": "rows", "value": 10 });

    console.log(data_arr);
    console.log($.param(data_arr));

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

      $.ajax({
        url: api_endpoint,
        type: "GET",
        data: search_data,
        dataType: 'json'
      }).done(function(response) {
        console.log(response);
        var terms = response.terms;

        if(terms.length > 0) {
          $("[data-search-dropdown]").empty();

          terms.each(function(i) {
            $("[data-search-dropdown]").append("<a href='#'>" + terms[i] + "</a>");
          });
        }

      }).always(function() {
        is_search_loading = false;
      });
    }
  }
}