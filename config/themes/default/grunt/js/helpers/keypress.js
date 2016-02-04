/* Register keypress events on the whole document when navigation exists
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Helpers.keyPress = function() {

  $(document).keydown(function(e) {
    switch(e.keyCode) {
      // user pressed "left" arrow
      case 37:
        if ($('#previous')[0]) {
          if (!e.altKey) {
            var previous = $('#previous');
            var previous_url = previous.attr("href");
            if (previous_url) {
              previous.addClass('hover').fadeTo(250, 1, function() {
                window.location = previous_url;
              });
            }
          }
        }
      break;
      // user pressed "top" arrow
      case 84: $('html,body').animate({scrollTop: 0}, 250);
      break;
      // user pressed "right" arrow
      case 39:
        if ($('#next')[0]) {
          if (!e.altKey) {
            var next = $('#next');
            var next_url = next.attr("href");
            if (next_url) {
              next.addClass('hover').fadeTo(250, 1, function() {
                window.location = next_url;
              });
            }
          }
        }
      break;
      // user pressed "up" arrow
      case 38:
          if (e.altKey) {
            var $parent_dir = $('.breadcrumb__folder');
            var parent_dir_url = $parent_dir.last().attr("href");
            if (parent_dir_url) {
              parent_dir.addClass('hover').fadeTo(250, 1, function() {
                window.location = parent_dir_url;
              });
            }
          }
      break;
    }
  });
}