/* --------------------------------------------------------------

main.js
* Subfolio by AREA 17

-------------------------------------------------------------- */

/* Setting up variables
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
var offsetMac = 0;

var collapse_header_label = 'collapse header';
var expand_header_label = 'expand header';

/* What to do when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
$(document).ready(function(){
  runOnDOMready();
});

/* Run when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function runOnDOMready() {
  bindInfoboxEvents(); // event handlers for the info box toggle
  // gallery(); // runs first to speed vertical/horizontal alignement rendering if needed.
  bindHeaderEvents();
  keyPress();
}

/* Show/Hide the header + cookie
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function bindHeaderEvents() {
  var $homeSwitch = $('#showHideSwitch');
  var $header = $('#header');

  if ($homeSwitch[0]) {
    $homeSwitch.click(function(e) {
      if ($(this).html() == expand_header_label) {
        $(this).addClass('hide');
        $(this).removeClass('show');
        $(this).html(collapse_header_label);
        $header.show();
        createCookie('header', 'show');
        return false;
      } else {
        $(this).addClass('show');
        $(this).removeClass('hide');
        $(this).html(expand_header_label);
        $header.hide();
        createCookie('header', 'hide');
        return false;
      }
    });
  }
}

/* Show/Hide the info box
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function bindInfoboxEvents() {

  var $info_bt = $('#info-button');

  if ($info_bt.length){
    $info_bt.click(function(el){
      $('#info-box').toggle();
      $info_bt.toggleClass('on')
      $.scrollTo('#footer');
      return false;
    });
  }
}

/* Cookies functions
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function createCookie(name, value) {
  var today = new Date();
  today.setTime(today.getTime()+(24*60*60*1000*365));
  var expires = "; expires=" + today.toGMTString();
  document.cookie = name+"=" + value + expires+"; path=/";
}

/* Gallery Module
   - Horizontal and vertical alignment of images
   - Handling image hover/click for IE6/7
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function gallery() {

	if ($('#gallery')[0]) {

		// Setting the context to optimize the each function
		var _context = $('#gallery').find('ul').find('li');
		var _galthumb = _context.find('a').find('.gallery_thumbnail');

		_galthumb.each(function() {

			if ($(this).hasClass("custom")) {

				// =TODO fix the bug in IE6/7

			} else {

				_img = $(this).find('img');
				var wImg = _img.width();
				var hImg = _img.height();
				var wP = $(this).parent().find("p").outerWidth();
				var hP = $(this).outerHeight();

				// If the image width is smaller than its container's then we align it horizontally
				if (wImg < wP) {
					// Setting the right width (based on the widest between the img and the filename)
					$(this).css("width", wP + "px");
					var m = wImg / 2;
					_img.css("position", "absolute");
					_img.css("left", "50%");
					_img.css("marginLeft", "-" + m + "px");
				}

				// If the image height is smaller than its container's then we align it vertically
				if (hImg < hP) {
					var m = hImg / 2;
					_img.css("position", "absolute");
					_img.css("top", "50%");
					_img.css("marginTop", "-" + m + "px");
				}
			}

		});
	}
}

/* Register keypress events on the whole document when navigation exists
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function keyPress () {

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