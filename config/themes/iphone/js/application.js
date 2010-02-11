var direction = null;
var threshold = {
    x: 120,
    y: 15
}

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
            //updateLocation();
        });
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

function addSwipeListener(el, listener) {
    var startX;
    var dx;
    var dy;
    var direction;
    var time;
    var tapThreshold = 1000;
    var imageFullWidth;
    
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
			if ((Math.abs(dx) == 0) && (Math.abs(dy) == 0) && (direction == null)) {
				if (!time) {
	                time = new Date().getTime();
	            } else {
	                if (new Date().getTime() - time < tapThreshold) {
	                   	//console.log('double tap, dx=' + Math.abs(dx) + ' , dy= ' + Math.abs(dy) + ' , direction= ' + direction);
						cancelTouch();
						onDoubleTap(e);
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
        }
    }

    function onDoubleTap(e) {
		var _img = $('.file_preview').children('img');
		if ($('body').hasClass('popping')) {
			console.log('popping out');
			$('html,body').animate({scrollTop: 0}, 800);
			$('body').removeClass('popping');
			isPopped = false;
			$('body').width(320);
			$('.tooltip').hide();
		} else {
			console.log('popping in');
			$('body').addClass('popping');
			isPopped = true;
			if (!imageFullWidth) imageFullWidth = _img.width();
			$('body').width(imageFullWidth);
			if (($('tooltip')[0])) {
				$('tooltip').show();
			} else {
				var info = '<span class="tooltip">Full Size</span>';
				$('body').append(info);
			}
			
		}
    }

	function startgesture(e) {
		//console.log('start : ' + e.scale);
		cancelTouch();
	}
	
	function gesturechange(e) {
		//console.log('change : ' + e.scale);
		cancelTouch();
	}
	
	function endgesture(e) {
		//console.log('end : ' + e.scale);
		cancelTouch();
	}
    el.addEventListener('touchstart', onTouchStart, false);
    document.addEventListener("gesturestart", startgesture, false);
	document.addEventListener("gesturechange", gesturechange, false);
	document.addEventListener("gestureend", endgesture, false);
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