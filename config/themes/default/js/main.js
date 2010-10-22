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

var collapse_header_label = 'collapse header';
var expand_header_label = 'expand header';

var useMasonry = true,
	masonry_options = {
		columnWidth: 5
	};

/* What to do when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
$(document).ready(function(){
	runOnDOMready();
});

/* Run when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function runOnDOMready() {
	
	/* Setting border for 1st child of the breadcrumb */
	if ($('#navigation')[0]) {
		$('#navigation').find('span.prev_next').find(":nth-child(1)").addClass("first");
	}
	
	browserDectect();
	bindInfoboxEvents(); // event handlers for the info box toggle
	gallery(); // runs first to speed vertical/horizontal alignement rendering if needed. 
	setUpClasses();
	keyPress();
	mason(); // runs jQuery Masonry on gallery and features if active
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
			if ($(this).html() == expand_header_label) {
				$(this).addClass('hide');
				$(this).removeClass('show');
				$(this).html(collapse_header_label);
				$('#header').show();
				createCookie('header', 'show');
				return false;
			} else {
				$(this).addClass('show');
				$(this).removeClass('hide');
				$(this).html(expand_header_label);
				$('#header').hide();
				createCookie('header', 'hide');
				return false;
			}
		});
	}
}

/* Show/Hide the info box
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function bindInfoboxEvents() {
	if ($('#info-button')){
		$('#info-button').click(function(el){
			$('#info-box').toggle();
			$('#info-button').toggleClass('on')
			$.scrollTo('#footer');
			return false;
		});
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
			
			if ($(this).hasClass("custom")) {
				
				// =TODO fix the bug in IE6/7
				
			} else {
				
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

/* Register keypress events on the whole document when navigation exists
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function keyPress () {
		
	$(document).keydown(function(e) {	
		switch(e.keyCode) {
			// user pressed "left" arrow
			case 37:
				if ($('#previous')[0]) {
			    if (!e.altKey) {
  					var previous = $('#previous');
  					var previous_url = previous.attr("href");
  					if (previous_url) {
  						previous.addClass('hover').fadeTo(250, 1, function() {
  							window.location = previous_url;
  						});
  					}
					}
				}
			break;				
			// user pressed "top" arrow
			case 84: $('html,body').animate({scrollTop: 0}, 250);
			break;
			// user pressed "right" arrow
			case 39: 
				if ($('#next')[0]) {
			    if (!e.altKey) {
  					var next = $('#next');
  					var next_url = next.attr("href");
  					if (next_url) {
  						next.addClass('hover').fadeTo(250, 1, function() {
  							window.location = next_url;
  						});
  					}
					}
				} 
			break;
      // user pressed "up" arrow
			case 38: 
			    if (e.altKey) {
  					var parent_dir = $('#parent');
  					var parent_dir_url = parent_dir.attr("href");
  					if (parent_dir_url) {
  						parent_dir.addClass('hover').fadeTo(250, 1, function() {
  							window.location = parent_dir_url;
  						});
  					}
					}
			break;
		}
	});
}

/* Applies jQuery Masonry to gallery and featues
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
function mason() {
	/* elems where to apply masonry */
	var elems = ['features', 'gallery'];

	// TO DO : if columnWidth set by user, overide the default masonry_options

	$.each(elems, function() {
		var el = $('#' + this);
		/* if masonry is used, 
			- force display:block on the container by adding mason_wrapper class 
			- apply Masonry
			- masoned elements appear once Masonry is done 
		   otherwise just make the elements appear 
		*/
		if (useMasonry)
			el.
				addClass('mason_wrapper')
				.children('ul').masonry(masonry_options, function() {
					el.css('opacity', 1);
				});
		else el.css('opacity', 1);
	});
}


/*************************************************
**  jQuery Masonry version 1.3.2
**  Copyright David DeSandro, licensed MIT
**  http://desandro.com/resources/jquery-masonry
**************************************************/
;(function($){  

  /*!
   * smartresize: debounced resize event for jQuery
   * http://github.com/lrbabe/jquery-smartresize
   *
   * Copyright (c) 2009 Louis-Remi Babe
   * Licensed under the GPL license.
   * http://docs.jquery.com/License
   *
   */
  var event = $.event,
      resizeTimeout;

  event.special.smartresize = {
    setup: function() {
      $(this).bind( "resize", event.special.smartresize.handler );
    },
    teardown: function() {
      $(this).unbind( "resize", event.special.smartresize.handler );
    },
    handler: function( event, execAsap ) {
      // Save the context
      var context = this,
          args = arguments;

      // set correct event type
      event.type = "smartresize";

      if (resizeTimeout) { clearTimeout(resizeTimeout); }
      resizeTimeout = setTimeout(function() {
        jQuery.event.handle.apply( context, args );
      }, execAsap === "execAsap"? 0 : 0);
    }
  };

  $.fn.smartresize = function( fn ) {
    return fn ? this.bind( "smartresize", fn ) : this.trigger( "smartresize", ["execAsap"] );
  };



  // masonry code begin
  $.fn.masonry = function(options, callback) { 

    // all my sweet methods
    var msnry = {
      getBricks : function($wall, props, opts) {
        var hasItemSelector = (opts.itemSelector === undefined);
        if ( opts.appendedContent === undefined ) {
          // if not appendedContent
          props.$bricks = hasItemSelector ?
                $wall.children() :
                $wall.find(opts.itemSelector);
        } else {
         //  if appendedContent...
         props.$bricks = hasItemSelector ?
                opts.appendedContent : 
                opts.appendedContent.filter( opts.itemSelector );
        }
      },
      
      placeBrick : function($brick, setCount, setY, props, opts) {
            // get the minimum Y value from the columns...
        var minimumY = Math.min.apply(Math, setY),
            setHeight = minimumY + $brick.outerHeight(true),
            i = setY.length,
            shortCol = i,
            setSpan = props.colCount + 1 - i;
        // Which column has the minY value, closest to the left
        while (i--) {
          if ( setY[i] == minimumY ) {
            shortCol = i;
          }
        }
            
        var position = {
          left: props.colW * shortCol + props.posLeft,
          top: minimumY
        };
            
        // position the brick
        $brick.applyStyle(position, $.extend(true,{},opts.animationOptions) );

        // apply setHeight to necessary columns
        for ( i=0; i < setSpan; i++ ) {
          props.colY[ shortCol + i ] = setHeight;
        }
      },
      
      setup : function($wall, opts, props) {
        msnry.getBricks($wall, props, opts);

        if ( props.masoned ) {
          props.previousData = $wall.data('masonry');
        }

        if ( opts.columnWidth === undefined) {
          props.colW = props.masoned ?
              props.previousData.colW :
              props.$bricks.outerWidth(true);
        } else {
          props.colW = opts.columnWidth;
        }

        props.colCount = Math.floor( $wall.width() / props.colW ) ;
        props.colCount = Math.max( props.colCount, 1 );
      },
      
      arrange : function($wall, opts, props) {
        var i;

        if ( !props.masoned || opts.appendedContent !== undefined ) {
          // just the new bricks
          props.$bricks.css( 'position', 'absolute' );
        }

        // if masonry hasn't been called before
        if ( !props.masoned ) { 
          $wall.css( 'position', 'relative' );

          // get top left position of where the bricks should be
          var $cursor = $( document.createElement('div') );
          $wall.prepend( $cursor );
          props.posTop =  Math.round( $cursor.position().top );
          props.posLeft = Math.round( $cursor.position().left );
          $cursor.remove();
        } else {
          props.posTop =  props.previousData.posTop;
          props.posLeft = props.previousData.posLeft;
        }
        
        // set up column Y array
        if ( props.masoned && opts.appendedContent !== undefined ) {
          // if appendedContent is set, use colY from last call
          props.colY = props.previousData.colY;

          /*
          *  in the case that the wall is not resizeable,
          *  but the colCount has changed from the previous time
          *  masonry has been called
          */
          for ( i = props.previousData.colCount; i < props.colCount; i++) {
            props.colY[i] = props.posTop;
          }

        } else {
          // start new colY array, with starting values set to posTop
          props.colY = [];
          i = props.colCount;
          while (i--) {
            props.colY.push(props.posTop);
          }
        }

        // are we animating the rearrangement?
        // use plugin-ish syntax for css or animate
        $.fn.applyStyle = ( props.masoned && opts.animate ) ? $.fn.animate : $.fn.css;


        // layout logic
        if ( opts.singleMode ) {
          props.$bricks.each(function(){
            var $brick = $(this);
            msnry.placeBrick($brick, props.colCount, props.colY, props, opts);
          });      
        } else {
          props.$bricks.each(function() {
            var $brick = $(this),
                //how many columns does this brick span
                colSpan = Math.ceil( $brick.outerWidth(true) / props.colW);
            colSpan = Math.min( colSpan, props.colCount );

            if ( colSpan === 1 ) {
              // if brick spans only one column, just like singleMode
              msnry.placeBrick($brick, props.colCount, props.colY, props, opts);
            } else {
              // brick spans more than one column

              //how many different places could this brick fit horizontally
              var groupCount = props.colCount + 1 - colSpan,
                  groupY = [];

              // for each group potential horizontal position
              for ( i=0; i < groupCount; i++ ) {
                // make an array of colY values for that one group
                var groupColY = props.colY.slice(i, i+colSpan);
                // and get the max value of the array
                groupY[i] = Math.max.apply(Math, groupColY);
              }

              msnry.placeBrick($brick, groupCount, groupY, props, opts);
            }
          }); //    /props.bricks.each(function() {
        }  //     /layout logic

        // set the height of the wall to the tallest column
        props.wallH = Math.max.apply(Math, props.colY);
        var wallCSS = { height: props.wallH - props.posTop };
        $wall.applyStyle( wallCSS, $.extend(true,[],opts.animationOptions) );

        // add masoned class first time around
        if ( !props.masoned ) { 
          // wait 1 millisec for quell transitions
          setTimeout(function(){
            $wall.addClass('masoned'); 
          }, 1);
        }

        // provide props.bricks as context for the callback
        callback.call( props.$bricks );

        // set all data so we can retrieve it for appended appendedContent
        //    or anyone else's crazy jquery fun
        $wall.data('masonry', props );
        
      }, // /msnry.arrange
      
      resize : function($wall, opts, props) {
        props.masoned = !!$wall.data('masonry');
        var prevColCount = $wall.data('masonry').colCount;
        msnry.setup($wall, opts, props);
        if ( props.colCount != prevColCount ) {
          msnry.arrange($wall, opts, props);
        }
      }
    };


    /*
    *  let's begin
    *  IN A WORLD...
    */
    return this.each(function() {  

      var $wall = $(this),
          props = {};

      // checks if masonry has been called before on this object
      props.masoned = !!$wall.data('masonry');
    
      var previousOptions = props.masoned ? $wall.data('masonry').options : {},
          opts =  $.extend(
                    {},
                    $.fn.masonry.defaults,
                    previousOptions,
                    options
                  ),
          resizeOn = previousOptions.resizeable;

      // should we save these options for next time?
      props.options = opts.saveOptions ? opts : previousOptions;

      //picked up from Paul Irish
      callback = callback || function(){};

      msnry.getBricks($wall, props, opts);

      // if brickParent is empty, do nothing, go back home and eat chips
      if ( !props.$bricks.length ) { 
        return this; 
      }

      // call masonry layout
      msnry.setup($wall, opts, props);
      msnry.arrange($wall, opts, props);
    
      // binding window resizing
      if ( !resizeOn && opts.resizeable ) {
        $(window).bind('smartresize.masonry', function() { msnry.resize($wall, opts, props); } );
      }
      if ( resizeOn && !opts.resizeable ) { 
        $(window).unbind('smartresize.masonry'); 
      }
       

    });    //    /return this.each(function()
  };      //    /$.fn.masonry = function(options)


  // Default plugin options
  $.fn.masonry.defaults = {
    singleMode: false,
    columnWidth: undefined,
    itemSelector: undefined,
    appendedContent: undefined,
    saveOptions: true,
    resizeable: true,
    animate: false,
    animationOptions: {}
  };

})(jQuery);