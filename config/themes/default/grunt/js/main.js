/* --------------------------------------------------------------

main.js
* Subfolio by AREA 17

-------------------------------------------------------------- */

// set up a master object
var A17 = window.A17 || {};

// set up some objects within the master one, to hold my Helpers and behaviors
A17.Behaviors = {};
A17.Util = {};
A17.Helpers = {};
A17.media_query_in_use = "xlarge";

// look through the document (or ajax'd in content if "context" is defined) to look for "data-behavior" attributes.
// Initialize a new instance of the method if found, passing through the element that had the attribute
// So in this example it will find 'data-behavior="show_articles"' and run the show_articles method.
A17.LoadBehavior = function(context){
  if(context === undefined){
    context = document;
  }
  var all = context.querySelectorAll("[data-behavior]");
  var i = -1;
  while (all[++i]) {
    var currentElement = all[i];
    var behaviors = currentElement.getAttribute("data-behavior");
    var splitted_behaviors = behaviors.split(" ");
    for (var j = 0, k = splitted_behaviors.length; j < k; j++) {
      var thisBehavior = A17.Behaviors[splitted_behaviors[j]];
      if(typeof thisBehavior !== "undefined") {
        thisBehavior.call(currentElement, $(currentElement));
      }
    }
  }
};

/* What to do when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
document.addEventListener("DOMContentLoaded", function(){
  A17.onReady();
});

/* Run when DOM is ready
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.onReady = function(){
  // sort out which media query we're using
  A17.media_query_in_use = A17.Helpers.get_media_query_in_use();

  // go go go
  A17.LoadBehavior();

  A17.Helpers.keyPress();

  // on resize, check
  var resize_timer;
  $(window).on("resize", function(){
    clearTimeout(resize_timer);
    resize_timer = setTimeout(function(){
      A17.Helpers.resized();
    },250);
  });
}

/* Cookies functions
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Util.create_cookie = function(name, value) {
  var today = new Date();
  today.setTime(today.getTime()+(24*60*60*1000*365));
  var expires = "; expires=" + today.toGMTString();
  document.cookie = name+"=" + value + expires+"; path=/";
}

