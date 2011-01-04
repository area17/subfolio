addEventListener("load", function() { 
	runOnLoaded(); 
}, false);

/* Run when Page is loaded
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function runOnLoaded() {
	setTimeout(hideURLbar, 0);
}

function hideURLbar(){
	window.scrollTo(0,1);
}
