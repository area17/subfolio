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


/* What to do when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
$(document).ready(function(){
	//console.time("runOnDOMready");
	runOnDOMready();
	//console.timeEnd("runOnDOMready");
});

/* Run when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function runOnDOMready() {
	browserDectect();
	gallery(); // runs first to speed vertical/horizontal alignement rendering if needed. 
	setUpClasses();
	
	/* Testing iPhone behavior */
	//if (isIphone) {
		$('#listing ul li a span.filename').each(function() {
			$(this).append('<span class="ecetera"></span');
			$(this).append('<span class="ecetera2"></span');
		});
	//}
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
	
	/* Setting border for 1st child of the breadcrumb */
	if ($('#navigation')[0]) {
		$('#navigation').find('span.prev_next').find(":nth-child(1)").addClass("first");
	}
	
	if ($('#content')[0]) {
		
		/* Setting margin for all direct children of #content. This is a duplicate of a CSS rule but IE can't handle it so we put it here */
		$('#content > div').css("marginBottom", "15px");
		
		$('li:nth-child(even)').addClass("even");	
		$('li:first-child').addClass("first");
		$('li:last-child').addClass("last");
	}
	
	bindHeaderEvents();

}

/* Show/Hide the header + cookie
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function bindHeaderEvents() {
	if ($('#showHideSwitch')[0]) {
		$('#showHideSwitch').click(function(e) {
			if ($('#hideText').html() == 'expand header') {
				$(this).addClass('hideSwitch');
				$(this).removeClass('showSwitch');
				$('#hideText').html('collapse header');
				$('#header').show();
				createCookie('header', 'showSwitch');
			} else {
				$(this).addClass('showSwitch');
				$(this).removeClass('hideSwitch');
				$('#hideText').html("expand header");
				$('#header').hide();
				createCookie('header', 'hideSwitch');
			}
		});
		
		/* TODO = handle cookie in IE6 */
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






/* Remove the focus of the links
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function removeFocus () {
	// Remove links Focus 
	for(i=0;i<document.links.length;i++) {
		document.links[i].onfocus=function() {if(this.blur)this.blur()}; 
	}	
}


/* Open a popup
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function pop(goPage,nom,windowWidth,windowHeight,style) {
	var x = 0;
	var y = 0;
	var offset = 30;
	var popped;
		
	if (screen) x = (screen.availWidth - windowWidth) / 2;
	if (screen) y = (screen.availHeight - windowHeight) / 2;
	
	
	if ( style == 'POP' ) { 
	    var popped = window.open(goPage,nom,'width='+windowWidth+',height='+(windowHeight+offsetMac)+',status=no,menubar=no,scrollbars=no,resizable=no,screenX='+x+',screenY='+y+',left='+x+',top='+y); 
    }
    
	if ( style == 'POPSCROLL' ) { 
	    var popped = window.open(goPage,nom,'width='+windowWidth+',height='+(windowHeight+offsetMac)+',status=no,menubar=no,scrollbars=yes,resizable=no,screenX='+x+',screenY='+y+',left='+x+',top='+y); 
    }

	if ( style == 'WINDOW' ) {
		if (windowHeight > screen.availHeight) windowHeight = (screen.availHeight - offset);
		var popped = window.open(goPage,nom,'width='+windowWidth+',height='+(windowHeight+offsetMac)+',status=yes,menubar=yes,scrollbars=yes,resizable=yes,screenX='+x+',screenY='+y+',left='+x+',top='+y);
	}
	
	if ( isMozilla || document.all) popped.focus();
	if ( !popped.opener) { popped.opener = window; }
}


/* InfoHideSwitch
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function InfoHideSwitch (box, button) {
    if (document.getElementById) {
        var box_id = document.getElementById(box);
		var button_id = document.getElementById(button);

        if (box_id.className == "show") {
            // collapse
            box_id.className = 'hide';
			button_id.className = '';
        } else { 
            // expand
            box_id.className = 'show';
			button_id.className = 'on';
			scrollToBottom();
        }
    }
}

/* Scroll to bottom
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function scrollToBottom () {
	window.scrollTo(0,5000);
}

/* Hide flash
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function hideFlash(theid) {
	if (document.getElementById) {
      var notice_id = document.getElementById(theid);
	  notice_id.className = 'hide';
  }
}

