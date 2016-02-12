/* Register keypress events on the whole document when navigation/search exists
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Helpers.keyPress = function() {

  var $body = $('body');
  var $previous = $('#previous');
  var $next = $('#next');
  var is_search_active = false;

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
          if($previous.length && !is_search_active) {
            var previous_url = $previous.attr("href");
            if(previous_url) _triggerHover($previous, previous_url);
          }
        break;

        // user pressed "up" arrow
        case 38:
          if($list.length && !is_search_active) _setFocused("prev", e);
        break;
        // user pressed "right" arrow
        case 39:
          if($next.length && !is_search_active) {
            var next_url = $next.attr("href");
            if(next_url) _triggerHover($next, next_url);
          }
        break;
        // user pressed "down" arrow
        case 40:
          if($list.length && !is_search_active) {
            _setFocused("next", e);
          }
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

  function _setData(data_arr) {
    // misc requiered params
    data_arr.push({ "name": "start", "value": 0 });
    data_arr.push({ "name": "rows", "value": 10 });
    return $.param(data_arr);
  }

  function _buildResults(document) {
    var template = $search_template.html();
    var template_item = template;

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

    });

    return template_item;
  }

  function _performQuery() {

    var api_endpoint = $search_form.attr("action");

    $search_form.on('submit', function(e) {
      e.preventDefault();

      if(is_search_loading) return false;

      var data_arr = $('input', $search_form).not("[data-json-based]").serializeArray();
      var data_json = $('input', $search_form).not("[data-get-based]").serializeJSON();

      is_search_loading = true;
      $search_dropdown.empty().addClass('invisible');

      console.log(data_json);

      $.ajax({
        url: api_endpoint + "?" + $.param(data_arr),
        type: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        data: JSON.stringify(data_json),
        dataType: 'json',
        processData: false
      }).done(function(response) {

        $search_results.empty();

        if(response.documents) {
          // display response here
          var documents = response.documents;

          if(documents.length > 0) {
            $.each(documents, function() {

              var document = this;
              var template_item = _buildResults(document);
              $search_results.append(template_item);
            });
          }
        }
      }).always(function() {
        is_search_loading = false;
      });

    });
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

        $search_dropdown.empty();

        if(response.terms) {
          var terms = response.terms;

          if(terms.length > 0) {
            $search_dropdown.removeClass('invisible');

            $.each(terms, function(i) {
              $search_dropdown.append("<a href='#'>" + terms[i] + "</a>");
            });
          } else {
            $search_dropdown.addClass('invisible');
          }
        } else {
          $search_dropdown.addClass('invisible');
        }
      }).always(function() {
        is_search_loading = false;
      });
    }
  }
}