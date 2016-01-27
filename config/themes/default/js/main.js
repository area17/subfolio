/* --------------------------------------------------------------

main.js
* Subfolio by AREA 17

-------------------------------------------------------------- */

/* Setting up variables
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
var isSafari = false;
var isSafari3 = false;
var isSafari4 = false;
var isIE = false;
var isIE6 = false;
var isIE7 = false;
var isIE8 = false;
var isMozilla = false;
var isOpera = false;
var isMac = false;
var isIphone = false;

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
	browserDectect();
	bindInfoboxEvents(); // event handlers for the info box toggle
	gallery(); // runs first to speed vertical/horizontal alignement rendering if needed.
	setUpClasses();
	keyPress();
}

/* Browser Detect
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function browserDectect() {

	function searchVersion(browser) {
		var dataString = navigator.userAgent;
		var index = dataString.indexOf(browser);
		if (index == -1) return;
		var bVersion = parseFloat(dataString.substring(index+browser.length+1));
		return bVersion.toString().split(".")[0];
	}

	// are we on a Mac ?
	if (navigator.appVersion.indexOf("Mac")!=-1) {
		isMac = true;
		$('body').addClass("isMac");
	}

	// Safari versioning
	isSafari =  jQuery.browser.safari;
	if (isSafari) {
		$('body').addClass("isSafari");
		version = searchVersion("Version") || + "";
		$('body').addClass("isSafari"+version);
		isSafari3 = (version == 3) ? true : false;
		isSafari4 = (version == 4) ? true : false;
	}

	// IE versioning
	isIE = jQuery.browser.msie;
	if (isIE) {
		version = searchVersion("MSIE") || "";
		isIE6 = (version == 6) ? true : false;
		isIE7 = (version == 7) ? true : false;
		isIE8 = (version == 8) ? true : false;
	}

	// Mozilla versioning
	isMozilla = jQuery.browser.mozilla;
	if (isMozilla) {
		$('body').addClass("isMozilla");
		version = searchVersion("Firefox") || "";
		$('body').addClass("isMozilla"+version);
	}

	// Opera versioning
	isOpera = jQuery.browser.opera;
	if (isOpera) {
		$('body').addClass("isOpera");
	}

	// iPhone
	if (navigator.userAgent.indexOf("iPhone") != -1) {
		isIphone = true;
		$('body').addClass("isIphone");
	}

}

/* Setting classes to handle cross browser dom parsing
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function setUpClasses() {

	if ($('#content')[0]) {
		$('li:nth-child(even)').addClass("even");
	}

	bindHeaderEvents();

}

/* Show/Hide the header + cookie
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function bindHeaderEvents() {
	if ($('#showHideSwitch')[0]) {
		$('#showHideSwitch').click(function(e) {
			if ($(this).html() == expand_header_label) {
				$(this).addClass('hide');
				$(this).removeClass('show');
				$(this).html(collapse_header_label);
				$('#header').show();
				createCookie('header', 'show');
				return false;
			} else {
				$(this).addClass('show');
				$(this).removeClass('hide');
				$(this).html(expand_header_label);
				$('#header').hide();
				createCookie('header', 'hide');
				return false;
			}
		});
	}
}

/* Show/Hide the info box
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function bindInfoboxEvents() {
	if ($('#info-button')){
		$('#info-button').click(function(el){
			$('#info-box').toggle();
			$('#info-button').toggleClass('on')
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

		if (isIE6 || isIE7) {
			$('#gallery').find('ul').find('li').click(function(e) {
				e.preventDefault();
				var href = $(this).find("a").attr("href");
				if (href != "#" && href != "" && href != undefined) {
					window.location = href;
				}
			});
			$('#gallery').find('ul').find('li').hover(function(){
				$(this).addClass("hover");
			}, function() {
				$(this).removeClass("hover");
			});
		}

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
  					var parent_dir = $('#parent');
  					var parent_dir_url = parent_dir.attr("href");
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