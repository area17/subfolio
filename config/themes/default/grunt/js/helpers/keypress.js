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
  var $search_input = $('[data-search-input]');
  var klass_search_active = "search__active";
  var search_data = "";
  var is_search_active = false;
  var is_search_loading = false;

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
          if(is_search_active && $search.length) _hide_search();
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
              if(!is_search_active) _show_search();
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

  // search engine
  function _show_search() {
    $body.addClass(klass_search_active);
    if($search.is(':visible')) $search_input.focus();

     $search_input.on('keyup.keyup_ajax', function (event) {
      setTimeout(function () { _perform_query(); }, 250);
    });

    is_search_active = true;
  }

  function _hide_search() {
    $body.removeClass(klass_search_active);
    $search_input.val('');

    is_search_active = false;
  }

  function _perform_query() {
    if(is_search_loading) return false;

    var $search_form = $search.find('form');
    var api_endpoint = $search.data("url");
    var data = $('input', $search_form).serialize();

    if(search_data != data) {
      is_search_loading = true;
      search_data = data;

      $.ajax({
        url: api_endpoint,
        type: "GET",
        data: search_data,
        dataType: 'json'
      }).done(function(response) {
        // display response here
      }).always(function() {
        is_search_loading = false;
      });
    }
  }
}