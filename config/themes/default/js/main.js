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
		$('#navigation').find('span.prev_next').children(':first').addClass("first");
	}
	
	if ($('#content')[0]) {
		
		/* Setting margin for all direct children of #content. This is a duplicate of a CSS rule but IE can't handle it so we put it here */
		$('#content > div').css("marginBottom", "15px");
		
		$('li:nth-child(even)').addClass("even");	
		$('li:first-child').addClass("first");
		$('li:last-child').addClass("last");
	}

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




/* Browser Detect Lite  v1.01
   http://www.dithered.com/javascript/browser_detect/index.html
   modified by Chris Nott (chris@dithered.com)
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
/*function BrowserDetectLite() {
	var agent = navigator.userAgent.toLowerCase(); 
	
	// Browser version
	this.versionMajor = parseInt(navigator.appVersion); 
	this.versionMinor = parseFloat(navigator.appVersion); 

	// Browser name
	this.ns    = (agent.indexOf('mozilla')!=-1 && agent.indexOf('spoofer')==-1 && agent.indexOf('compatible') == -1 && agent.indexOf('opera')==-1 && agent.indexOf('webtv')==-1); 
	this.ns2   = (this.ns && this.versionMajor == 2); 
	this.ns3   = (this.ns && this.versionMajor == 3); 
	this.ns4   = (this.ns && this.versionMajor == 4); 
	this.ns4up = (this.ns && this.versionMajor >= 4); 
	this.ns6   = (this.ns && this.versionMajor == 5); 
	this.ns6up = (this.ns && this.versionMajor >= 5); 
	this.ie    = (agent.indexOf("msie") != -1); 
	this.ie3   = (this.ie && this.versionMajor < 4); 
	this.ie4   = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 4.0") != -1); 
	this.ie4up = (this.ie && this.versionMajor >= 4); 
	this.ie5   = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 5.0") != -1); 
	this.ie55  = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 5.5") != -1);
	this.ie5up = (this.ie && !this.ie3 && !this.ie4); 
	this.ie6   = (this.ie && this.versionMajor == 4 && agent.indexOf("msie 6.0") != -1);
	this.ie6up = (this.ie && !this.ie3 && !this.ie4 && !this.ie5 && !this.ie55); 
	this.opera = (agent.indexOf("opera") != -1); 
	this.webtv = (agent.indexOf("webtv") != -1); 
	this.aol   = (agent.indexOf("aol") != -1); 
	
	// Javascript version
	this.js = 0.0;
	if (this.ns2 || this.ie3) this.js = 1.0 
	else if (this.ns3 || this.opera || (document.images && this.ie && !this.ie4up)) this.js = 1.1 
	else if ((this.ns4 && this.versionMinor <= 4.05) || this.ie4) this.js = 1.2 
	else if ((this.ns4 && this.versionMinor > 4.05) || this.ie5up) this.js = 1.3 
	else if (this.ns6up) this.js = 1.4 

	// Platform type
	this.win   = (agent.indexOf("win")!=-1 || agent.indexOf("16bit")!=-1);
	this.win32 = (agent.indexOf("win95")!=-1 || agent.indexOf("windows 95")!=-1 || agent.indexOf("win98")!=-1 || agent.indexOf("windows 98")!=-1 || agent.indexOf("winnt")!=-1 || agent.indexOf("windows nt")!=-1 || (this.versionMajor >= 4 && navigator.platform == "win32") || agent.indexOf("win32")!=-1 || agent.indexOf("32bit")!=-1);
	this.mac   = (agent.indexOf("mac")!=-1);
}*/


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


/* Show/Hide element switch
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function showHideSwitch (theid, lnk) {
    if (document.getElementById) {
        var switch_id = document.getElementById(theid);

        if (switch_id.className == "showSwitch") {
            // collapse
            switch_id.className = 'hideSwitch';
            lnk.innerHTML = "expand header";

            var today = new Date();
            expires = 365 * 1000 * 60 * 60 * 24;
            var expires_date = new Date( today.getTime() + (expires) );
            document.cookie = theid+'=hideSwitch'+'; path=/' + ";expires=" + expires_date.toGMTString();
        } else { 
            // expand
            switch_id.className = 'showSwitch';
            lnk.innerHTML = "collapse header";

            var today = new Date();
            expires = 365 * 1000 * 60 * 60 * 24;
            var expires_date = new Date( today.getTime() + (expires) );
            document.cookie = theid+'=showSwitch'+'; path=/' + ";expires=" + expires_date.toGMTString();
        }
    }
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

