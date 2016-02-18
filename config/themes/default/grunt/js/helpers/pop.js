/* Open a popup
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Helpers.pop = function(goPage,nom,windowWidth,windowHeight,style) {
  var x = 0;
  var y = 0;
  var offset = 30;
  var popped;

  if (screen) x = (screen.availWidth - windowWidth) / 2;
  if (screen) y = (screen.availHeight - windowHeight) / 2;

  if ( style.toUpperCase() == 'POP' ) {
      var popped = window.open(goPage,nom,'width='+windowWidth+',height='+(windowHeight)+',status=no,menubar=no,scrollbars=no,resizable=no,screenX='+x+',screenY='+y+',left='+x+',top='+y);
    }

  if ( style.toUpperCase() == 'POPSCROLL' ) {
      var popped = window.open(goPage,nom,'width='+windowWidth+',height='+(windowHeight)+',status=no,menubar=no,scrollbars=yes,resizable=no,screenX='+x+',screenY='+y+',left='+x+',top='+y);
    }

  if ( style.toUpperCase() == 'WINDOW' ) {
    if (windowHeight > screen.availHeight) windowHeight = (screen.availHeight - offset);
    var popped = window.open(goPage,nom,'width='+windowWidth+',height='+(windowHeight)+',status=yes,menubar=yes,scrollbars=yes,resizable=yes,screenX='+x+',screenY='+y+',left='+x+',top='+y);
  }

  if (document.all) popped.focus();
  if ( !popped.opener) { popped.opener = window; }
}