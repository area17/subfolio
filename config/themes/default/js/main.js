/* -------------------------------------------------------------- 

main.js
* Subfolio by AREA 17

-------------------------------------------------------------- */

/* What to do when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
$(document).ready(function(){
	runOnDOMready();
});

/* Run when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function runOnDOMready() {	
	var is = new BrowserDetectLite();
	if (is.mac) { var offsetMac = 0; } else { var offsetMac = 0; }
	setUpClasses();
	alignHV();
}

/* Setting classes to handle cross browser dom parsing
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function setUpClasses() {
	$('li:nth-child(even)').addClass("even");	
	$('li:first-child').addClass("first");
	$('li:last-child').addClass("last");
}

function alignHV() {
	
	if ($('#gallery')[0]) {
		
		$('#gallery ul li a div.gallery_thumbnail').each(function() {
			
			// Setting the right width (based on the widest between the img and the filename)
			var wImg = $(this).find("img").width();
			var wP = $(this).parent().find("p").outerWidth();
			if (wImg < wP) {
				$(this).css("width", wP + "px");
			}
			
			// Horizontal align
			var m = wImg / 2;
			$(this).find("img").css("position", "absolute");
			$(this).find("img").css("left", "50%");
			$(this).find("img").css("marginLeft", "-" + m + "px");
			
			// Vertical align
			var h = $(this).find("img").height();
			m = h / 2;
			$(this).find("img").css("top", "50%");
			$(this).find("img").css("marginTop", "-" + m + "px");
			
		});
	}
	
}


/* Browser Detect Lite  v1.01
   http://www.dithered.com/javascript/browser_detect/index.html
   modified by Chris Nott (chris@dithered.com)
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function BrowserDetectLite() {
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
	
	if ( is.ns || document.all) popped.focus();
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

/* Rollover
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

