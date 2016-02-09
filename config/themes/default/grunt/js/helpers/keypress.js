/* Register keypress events on the whole document when navigation exists
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Helpers.keyPress = function() {

  var $previous = $('#previous');
  var $next = $('#next');
  var klass_focused = "list__row--focused";
  var klass_row = "list__body";
  var $list = $('.list--list');

  $(document).on("keydown", function(e) {

    switch(e.keyCode) {
      // user pressed "left" arrow
      case 37:
        if ($previous.length) {
          if (!e.altKey) {
            var previous_url = $previous.attr("href");
            if(previous_url) _triggerHover($previous, previous_url);
          }
        }
      break;
      // user pressed "top" arrow
      case 84: $('html,body').animate({scrollTop: 0}, 250);
      break;

      // user pressed "up" arrow
      case 38:

        if(!e.altKey) {
          if($list.length) _setFocused("prev", e);
        }
      break;
      // user pressed "right" arrow
      case 39:
        if($('.' + klass_focused).length) {
          var next_url = $('.' + klass_focused).attr("href");
          if (next_url) window.location = next_url;

        } else {
          if ($next.length) {
            if (!e.altKey) {
              var next_url = $next.attr("href");
              if(next_url) _triggerHover($next, next_url);
            }
          }
        }


      break;
      // user pressed "down" arrow
      case 40:

        if(!e.altKey) {
          if($list.length) _setFocused("next", e);
        }
      break;
      default:
        // launch search!
        A17.Helpers.search(e);
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
    if($('.' + klass_focused).length) {
      var $focused_one = $('.' + klass_focused);
      if(dir === "next") var $next_one = $focused_one.next("." + klass_row);
      else var $next_one = $focused_one.prev("." + klass_row);

      if($next_one.length) $next_one.addClass(klass_focused);
      $focused_one.removeClass(klass_focused);

      e.preventDefault();
    } else {
      if(dir === "next") $("." + klass_row, $list.first()).first().addClass(klass_focused);
      else $("." + klass_row, $list.first()).last().addClass(klass_focused);
    }
  }
}