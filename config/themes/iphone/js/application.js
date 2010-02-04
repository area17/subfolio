var direction = null;
var threshold = {
	x : 120,
	y : 15
}

/* What to do when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
$(document).ready(function(){ runOnDOMready(); });
addEventListener("load", function() { runOnLoaded(); }, false);

/* Run when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function runOnDOMready() {
	
	if ($('.prev_next')[0]) {
		addSwipeListener(document.body, function(e) { 
			direction = e.direction;
			bounce();
		});
	}
	
	if ($('#file_preview')[0]) {
		var file_preview = document.getElementById('file_preview');
		addTapListener(file_preview, function(e) {
			e.preventDefault();
		});
	}
	
}

/* Run when Page is loaded
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function runOnLoaded() {
	setTimeout(hideURLbar, 0);
}


function hideURLbar(){
	window.scrollTo(0,1);
}

function bounce() {
	
	if (direction == 'left') {
		if (!$('#next').hasClass('faded') && $('#next').attr('href').length > 0 ) {
			if ($('#next').attr('href') != '#') {
        		// $('.file').addClass('swipeLeft');
        		// setTimeout(updateLocation, 900);
        		$('#next').addClass('active');
				updateLocation();
			} 
		} 
	} else if (direction == 'right') {
		if (!$('#previous').hasClass('faded') && $('#previous').attr('href').length > 0 ) {
			if ($('#previous').attr('href') != '#') {
        		// $('.file').addClass('swipeRight');
        		// setTimeout(updateLocation, 900);
        		$('#previous').addClass('active');
				updateLocation();
			} 
		} 
	}
}

function updateLocation() {
	if (direction == 'left') {
		window.location = $('#next').attr('href');
	} else if (direction == 'right') {
		window.location = $('#previous').attr('href');
	}
}

/**
 * You can identify a swipe gesture as follows:
 * 1. Begin gesture if you receive a touchstart event containing one target touch.
 * 2. Abort gesture if, at any time, you receive an event with >1 touches.
 * 3. Continue gesture if you receive a touchmove event mostly in the x-direction.
 * 4. Abort gesture if you receive a touchmove event mostly the y-direction.
 * 5. End gesture if you receive a touchend event.
 * 
 * @author Dave Dunkin
 * @copyright public domain
 */
function addSwipeListener(el, listener)
{
 var startX;
 var dx;
 var direction;
 var startTime = 0;
 var deltaTime;
 
 function cancelTouch()
 {
  el.removeEventListener('touchmove', onTouchMove);
  el.removeEventListener('touchend', onTouchEnd);
  startX = null;
  startY = null;
  direction = null;
  dx = 0;
 }
 
 function onTouchMove(e)
 {
  if (e.touches.length > 1)
  {
   cancelTouch();
  }
  else
  {
   dx = e.touches[0].pageX - startX;
   var dy = e.touches[0].pageY - startY;
   
   if (direction == null)
   {
    direction = dx;
    e.preventDefault();
   }
   else if ((direction < 0 && dx > 0) || (direction > 0 && dx < 0) || Math.abs(dy) > threshold.y)
   {
    cancelTouch();
   }
  }
 }

 function onTouchEnd(e)
 {
	
  if (Math.abs(dx) > threshold.x)
  {
   listener({ target: el, direction: dx > 0 ? 'right' : 'left' });
   cancelTouch();	
  } else {
    // this is a tap
  }
 }
 
 function onTouchStart(e)
 {
  cancelTouch();	
  if (e.touches.length == 1)
  {
   startX = e.touches[0].pageX;
   startY = e.touches[0].pageY;
   el.addEventListener('touchmove', onTouchMove, false);
   el.addEventListener('touchend', onTouchEnd, false);
  } 
 }

 el.addEventListener('touchstart', onTouchStart, false);
}

function addTapListener(el, listener)
{
 var startX;
 var dx;
 var direction;
 var startTime = 0;
 var deltaTime;
 
 function cancelTouch()
 {
  el.removeEventListener('touchmove', onTouchMove);
  el.removeEventListener('touchend', onTouchEnd);
  startX = null;
  startY = null;
  direction = null;
  dx = 0;
 }
 
 function onTouchMove(e)
 {
  if (e.touches.length > 1)
  {
   
   cancelTouch();
  }
  else
  {
   dx = e.touches[0].pageX - startX;
   var dy = e.touches[0].pageY - startY;
   
   if (direction == null)
   {
    direction = dx;
    e.preventDefault();
   }
   else if ((direction < 0 && dx > 0) || (direction > 0 && dx < 0) || Math.abs(dy) > threshold.y)
   {
    cancelTouch();
   }
  }
 }

 function onTouchEnd(e)
 {
	
  if (Math.abs(dx) > threshold.x)
  {
   listener({ target: el, direction: dx > 0 ? 'right' : 'left' });
   cancelTouch();	
  } else {
    var src = $('#file_preview').attr('href');
    if (src != '#') 
		window.location = src;
    
  }
 }
 
 function onTouchStart(e)
 {
  cancelTouch();	
  if (e.touches.length == 1)
  {
   startTime = (new Date).getTime();
   
   e.preventDefault();
   el.addEventListener('touchmove', onTouchMove, false);
   el.addEventListener('touchend', onTouchEnd, false);
  } 
 }

 el.addEventListener('touchstart', onTouchStart, false);
}

function getElementsByClassName(classname, node)  {
    if(!node) node = document.getElementsByTagName("body")[0];
    var a = [];
    var re = new RegExp('\\b' + classname + '\\b');
    var els = node.getElementsByTagName("*");
    for(var i=0,j=els.length; i<j; i++)
        if(re.test(els[i].className))a.push(els[i]);
    return a;
}