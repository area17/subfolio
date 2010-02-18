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
	
	var moving = {};
	var time;
	var tapThreshold = 1000;
	
	if ($('#content').children().hasClass('file_img')) {
		//document.addEventListener("touchstart", toochHandler, false);
	}
	
	function doubleTap(element, e) {
		
		if ($('body').hasClass('popping')) {
			console.log('zoomed out');
			$('body').removeClass('popping')
			isPopped = false;
		} else {
			console.log('zoomed in');
			$('body').addClass('popping');
			isPopped = true;
		}
	}
	
	function toochHandler(e) {
		if (e.type == "touchstart") {
			for (var i = 0; i < e.touches.length; i++) {
			    // for each "movable" touch event:
				if (e.touches[i].target.className == "zoom") {
					var id = e.touches[i].identifier;
					// record initial data in the "moving" hash
					moving[id] = {
						identifier: id,
						target:   	e.touches[i].target,
						mouse:		{ x: e.touches[i].clientX, y: e.touches[i].clientY }
					};
					if (e.touches.length == 1) {
						if (!time) {
							time = new Date().getTime();
						} else {
							if (new Date().getTime() - time < tapThreshold) {
								moving[id].target.style.opacity = 0.5;
								doubleTap($('.zoom'), e);
							} 
							time = null;
						}
					}
				}
			}
		} 
	}
	
	var isPopped = false;
	
	if ($('body').hasClass('popping')) {
		isPopped = true;
	} else {
		isPopped = false;
	}
	
	if ($('.prev_next')[0] && !isPopped) {
		addSwipeListener(document.body, function(e) { 
			direction = e.direction;
			console.log(direction);
			bounce();
		});
	}

	/* Turned off since image is not embedded in an link */
	// if ($('#file_preview')[0]) {
	// 	var file_preview = document.getElementById('file_preview');
	// 	addTapListener(file_preview, function(e) {
	// 		e.preventDefault();
	// 	});
	// }
	
	// if ($('#file_preview')) {
	// 	var preview = $('#file_preview');
	// 	var meta;
	// 	preview.click(function() {
	// 		if ($('body').hasClass('popping')) {
	// 			$(this).removeClass('movable');
	// 			$('body').removeClass('popping')
	// 			isPopped = false;
	// 			$('meta[name=viewport]').attr("content", meta);
	// 		} else {
	// 			$(this).addClass('movable');
	// 			$('body').addClass('popping');
	// 			isPopped = true;
	// 			meta = $('meta[name=viewport]').attr("content");
	// 			$('meta[name=viewport]').attr("content", "");
	// 		}
	// 	});
	// }
	
	//document.addEventListener("gesturestart", startgesture, false);
    //document.addEventListener("gesturechange", gesturechange, false);
    //document.addEventListener("gestureend", gestureend, false);	
	

		
		function startgesture(e) {
			var node = e.target;
			if ($('body').hasClass('popping'))  {
				console.log('popping  mode = ' + e.scale);
				
			}	
			else {
				console.log('not popping mode = ' + e.scale);
				return false;
			}
				
		}
		
		// function gesturechange(e) {
		// 	var node = e.target;
		// 	if ($('body').hasClass('popping'))  {
		// 		console.log('popping');
		// 	}	
		// 	else {
		// 		console.log('not popping');
		// 		node.style.width *= 1;
		// 		node.style.height *= 1;
		// 	}
		// }
		// 
		// function gestureend(e) {
		// 	var node = e.target;
		// 	if ($('body').hasClass('popping'))  {
		// 		console.log('popping');
		// 	}	
		// 	else {
		// 		console.log('not popping');
		// 		node.style.width *= 1;
		// 		node.style.height *= 1;
		// 	}
		// }
	
	
	
	// var currentId;
	//     var objects = {};
	//     var zIndex = 0;
	// var gesture = {
	// 	start:1,
	// 	move:0,
	// 	end:0
	// };
	//   
	//     function init() {
	//         document.addEventListener("touchstart", startmove, false);
	//         document.addEventListener("touchmove", move, false);
	//         document.addEventListener("touchend", endmove, false);
	// 	
	//         makeObjectMovable(file_preview);
	//     }
	// 
	// function startgesture(e) {
	// 	gesture.start = e.scale;
	// 	//console.log('start : ' + gesture.start);
	// }
	// 
	// function gesturechange(e) {
	// 	gesture.change = e.scale;
	// 	//console.log('change : ' + e.scale);
	// }
	// 
	// function endgesture(e) {
	// 	gesture.end = e.scale;
	// 	//console.log('end : ' + gesture.end);
	// }
	// 
	//     function startmove(e) {
	//         for (var i=0; i < e.touches.length; i++) {
	//             if (e.touches[i].target.className == "movable") {
	// 			var touch = e.touches[i];
	//             var id = touch.identifier;
	//             currentId = id;
	//                 objects[id] = {
	//                     target: touch.target,
	//                     beginX: touch.clientX,
	//                     beginY: touch.clientY,
	//                     pozX: touch.target.pozXinit,
	//                     pozY: touch.target.pozYinit,
	// 				scale: gesture.start
	//                 }
	// 			
	//                 //touch.target.style.opacity = 0.5;
	//                 touch.target.style.zIndex = ++zIndex;
	// 			objects[id].scaleMode = false;
	// 			//console.log('start :' + objects[id].scale);
	//             }
	//             e.preventDefault();
	// 	}
	// 
	//     }
	// 
	//     function endmove(e) {
	//         // var touch = e.touches[0];
	//         //             var id = currentId;
	//         //             if (objects[id] != null) {
	//         //                 if (objects[id].target.className == "movable") {
	//         //                     objects[id].target.style.opacity = 1;
	//         //                 }
	//         //                 delete objects[id];
	//         //             }
	// 	for (var i=0; i < e.touches.length; i++)
	// 		delete objects[e.touches[i].identifier];
	//         e.preventDefault();
	//     }
	// 
	//     function move(e) {
	//         for (var i=0; i < e.touches.length; i++) {
	//             if (e.touches[i].target.className == "movable") {
	// 			// if there are two touches and it's the same element
	// 			if (e.touches.length == 2 && e.touches[0].target == e.touches[1].target) {
	// 				var idA = e.touches[0].identifier, idB = e.touches[1].identifier;
	// 				if (objects[idA].scaleMode && objects[idB].scaleMode) {
	// 					// calculate translation and scale
	// 					//console.log('calculate scale ' + gesture.start + ' - '+  gesture.change);
	// 					//objects[idA].target.scale = gesture.start * gesture.change;
	// 					
	// 					//console.log('move :' + objects[idA].scale + ' - ' + gesture.change + ' = ' + objects[idA].scale * gesture.change);
	// 					
	// 					//objects[idA].scale = objects[idA].scale * gesture.change;
	// 					//if (objects[idA].scale >= 1)
	// 					//	objects[idA].target.style['-webkit-transform'] = 
	// 					//	'scale(' + objects[idA].scale + ')';
	// 				} else {
	// 					objects[idA].scaleMode = objects[idB].scaleMode = true;
	// 					objects[idA].mouseCenter = objects[idB].mouseCenter	= {
	// 						x: (e.touches[0].clientX + e.touches[1].clientX) / 2,
	// 						y: (e.touches[0].clientY + e.touches[1].clientY) / 2,
	// 					}
	// 					objects[idA].positionCenter	= objects[idB].positionCenter	= {
	// 						x: objects[idA].target.xfmTX,
	// 						y: objects[idA].target.xfmTY
	// 					}
	// 				}
	// 
	// 
	// 			} else {
	// 				for (var i=0; i < e.touches.length; i++) {
	// 					var touch = e.touches[i];
	// 					var id = e.touches[i].identifier;
	// 					if (objects[id]) {
	// 						objects[id].scaleMode = false;
	// 						objects[id].target.pozXinit = objects[id].pozX + touch.clientX - objects[id].beginX;
	// 		                objects[id].target.pozYinit = objects[id].pozY + touch.clientY - objects[id].beginY;
	// 		                objects[id].target.style['-webkit-transform'] = 
	// 							'translate(' + objects[id].target.pozXinit + 'px,' + objects[id].target.pozYinit + 'px)',
	// 					}
	// 				}
	// 
	// 			}
	// 			e.preventDefault();
	//             }
	//            
	// 	}
	//     }
	// 
	//     function makeObjectMovable(obj) {
	//         obj.className = "movable";
	//         obj.pozXinit = 0;
	//         obj.pozYinit = 0;
	//     }

	
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
   //console.log('1');
   startX = e.touches[0].pageX;
   startY = e.touches[0].pageY;
   el.addEventListener('touchmove', onTouchMove, false);
   el.addEventListener('touchend', onTouchEnd, false);
  } else if (e.touches.length == 2) {
	
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