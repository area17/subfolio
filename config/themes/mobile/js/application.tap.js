var direction = null;
var threshold = {
    x: 120,
    y: 15
}
var imageFullWidth;
var currentBodyWidth;

/* What to do when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
$(document).ready(function () {
    runOnDOMready();
});
addEventListener("load", function () {
    runOnLoaded();
},
false);

/* Run when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/

function runOnDOMready() {

    var isPopped = false;

    if ($('body').hasClass('popping')) {
        isPopped = true;
    } else {
        isPopped = false;
    }

    if ($('.prev_next')[0] && !isPopped) {
        addSwipeListener(document.body, function (e) {
            direction = e.direction;
            bounce();
            updateLocation();
        });
    }

	if ($('.file_preview')[0]) {
		$('.btn_download').click(function(e) {
			e.preventDefault();
			setTimeout(fullSize, 800);
		})
	}
}

/* Run when Page is loaded
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/

function runOnLoaded() {
    setTimeout(hideURLbar, 0);
}


function hideURLbar() {
    window.scrollTo(0, 1);
}

function bounce() {

    if (direction == 'left') {
        if (!$('#next').hasClass('faded') && $('#next').attr('href').length > 0) {
            if ($('#next').attr('href') != '#') {
                $('#next').addClass('active');
            }
        }
    } else if (direction == 'right') {
        if (!$('#previous').hasClass('faded') && $('#previous').attr('href').length > 0) {
            if ($('#previous').attr('href') != '#') {
                $('#previous').addClass('active');
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

function fullSize() {
	var _img = $('.file_preview').children('img');
	if ($('body').hasClass('popping')) {
		console.log('popping out ');
		
		// enable scaling
		document.getElementById("viewport").setAttribute('content','width=device-width,user-scalable=1,initial-scale=1.0, minimum-scale=1.0, maximum-scale = 10');
		
		// turn on normal mode
		$('body').removeClass('popping');
		isPopped = false;
		$('body').width(currentBodyWidth);
		
		// turn off 100% mode indicator
		$('.tooltip').hide();
		
		// scroll back to top
		$('html,body').animate({scrollTop: 0}, 800);
	} else {
		console.log('popping in : ' + _img.width() + ' ' + _img.outerWidth());
		
		// disable scaling
		document.getElementById("viewport").setAttribute('content','width=device-width,user-scalable=1,initial-scale=1.0, minimum-scale=1.0, maximum-scale = 1');
		// save current width
		currentBodyWidth = $('body').width();
		
		// turn on 100% mode
		$('body').addClass('popping');
		isPopped = true;
		if (!imageFullWidth) imageFullWidth = _img.width();
		$('body').width(imageFullWidth);
		
		// scroll back to top
		window.scrollTo(0, 1);
		
		// turn on 100% mode indicator
		if (($('tooltip')[0])) {
			$('tooltip').show();
		} else {
			var info = '<span class="tooltip">Full Size</span>';
			$('body').append(info);
		}
		
	}
}

function addSwipeListener(el, listener) {
    var startX;
    var dx;
    var dy;
    var direction;
    var time;
    var tapThreshold = 1000;

    
    function cancelTouch() {
        el.removeEventListener('touchmove', onTouchMove);
        el.removeEventListener('touchend', onTouchEnd);
        startX = null;
        startY = null;
        direction = null;
        dx = 0;
		dy = 0;
    }

    function onTouchMove(e) {
        if (e.touches.length > 1) {
            cancelTouch();
        } else {
            dx = e.touches[0].pageX - startX;
            dy = e.touches[0].pageY - startY;

            if (direction == null) {
                direction = dx;
                e.preventDefault();
            } else if ((direction < 0 && dx > 0) || (direction > 0 && dx < 0) || Math.abs(dy) > threshold.y) {
                cancelTouch();
            }
        }
    }

    function onTouchEnd(e) {

        if (Math.abs(dx) > threshold.x) {
            listener({
                target: el,
                direction: dx > 0 ? 'right' : 'left'
            });
            cancelTouch();
        } else {
			// no movement so it's gotta be a tap
			// let's detect double tap but only if there hasn't been a movement
			if ($('body').hasClass('popping') && (Math.abs(dx) == 0) && (Math.abs(dy) == 0) && (direction == null)) {
				if (!time) {
	                time = new Date().getTime();
	            } else {
	                if (new Date().getTime() - time < tapThreshold) {
	                   	//console.log('double tap, dx=' + Math.abs(dx) + ' , dy= ' + Math.abs(dy) + ' , direction= ' + direction);
						cancelTouch();
						fullSize();
	                }
	                time = null;
	            }
			}
        }
    }

    function onTouchStart(e) {
        cancelTouch();
        if (e.touches.length == 1) {
			startX = e.touches[0].pageX;
            startY = e.touches[0].pageY;
            el.addEventListener('touchmove', onTouchMove, false);
            el.addEventListener('touchend', onTouchEnd, false);
			if (e.touches[0].target.className == "file_meta") {
				isFileMeta = true;
			} else {
				isFileMeta = false;
			}
        }
    }

		//     function fullSize() {
		// var _img = $('.file_preview').children('img');
		// if ($('body').hasClass('popping')) {
		// 	console.log('popping out ');
		// 	
		// 	// enable scaling
		// 	document.getElementById("viewport").setAttribute('content','width=device-width,user-scalable=1,initial-scale=1.0, minimum-scale=1.0, maximum-scale = 10');
		// 	
		// 	// turn on normal mode
		// 	$('body').removeClass('popping');
		// 	isPopped = false;
		// 	$('body').width(currentBodyWidth);
		// 	
		// 	// turn off 100% mode indicator
		// 	$('.tooltip').hide();
		// 	
		// 	// scroll back to top
		// 	$('html,body').animate({scrollTop: 0}, 800);
		// } else {
		// 	console.log('popping in : ' + _img.width() + ' ' + _img.outerWidth());
		// 	
		// 	// disable scaling
		// 	document.getElementById("viewport").setAttribute('content','width=device-width,user-scalable=1,initial-scale=1.0, minimum-scale=1.0, maximum-scale = 1');
		// 	// save current width
		// 	currentBodyWidth = $('body').width();
		// 	
		// 	// turn on 100% mode
		// 	$('body').addClass('popping');
		// 	isPopped = true;
		// 	if (!imageFullWidth) imageFullWidth = _img.width();
		// 	$('body').width(imageFullWidth);
		// 	
		// 	// scroll back to top
		// 	$('html,body').animate({scrollTop: 0}, 800);
		// 	
		// 	// turn on 100% mode indicator
		// 	if (($('tooltip')[0])) {
		// 		$('tooltip').show();
		// 	} else {
		// 		var info = '<span class="tooltip">Full Size</span>';
		// 		$('body').append(info);
		// 	}
		// 	
		// }
		//     }

	function startgesture(e) {
		//console.log('start : ' + e.scale);
		scale.start = e.scale;
		scale.startAbs = scale.end;
		cancelTouch();
	}
	
	function gesturechange(e) {
		//console.log('change : ' + e.scale);
		scale.change = e.scale;
		cancelTouch();
	}
	
	function endgesture(e) {
		scale.end = e.scale;
		scale.coeff = scale.end - scale.start;
		cancelTouch();
		console.log('scale.start: ' + scale.start + ', scale.end: ' + scale.end + ', scale.coeff: ' + scale.coeff );
	}
	
	function updateOrientation() {
		switch(window.orientation) {
			case 0: //Portrait 
				$('html').addClass('portrait');
				break;
			case -90 : // landscape
				$('html').addClass('landscape');
				break;
			case 90 : // landscape 
				$('html').addClass('landscape');
				break;
			case 180 : // portrait
				$('html').addClass('portrait');
				break;
		}
	}
	
    el.addEventListener('touchstart', onTouchStart, false);
    //el.addEventListener('orientationchange', updateOrientation, false);

}


function getElementsByClassName(classname, node) {
    if (!node) node = document.getElementsByTagName("body")[0];
    var a = [];
    var re = new RegExp('\\b' + classname + '\\b');
    var els = node.getElementsByTagName("*");
    for (var i = 0, j = els.length; i < j; i++)
    if (re.test(els[i].className)) a.push(els[i]);
    return a;
}