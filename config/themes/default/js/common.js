/* -------------------------------------------------------------- 

common.js
* Subfolio by AREA 17

-------------------------------------------------------------- */

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


/* Hide flash
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function hideFlash(theid) {
	if (document.getElementById) {
      var notice_id = document.getElementById(theid);
	  notice_id.className = 'hide';
  }
}