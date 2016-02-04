A17.Behaviors.additional_content = function($script) {
  var script = $script[0];

  function _append() {
    if($script.hasClass("added") == false) {

      $script.addClass("added");
      script.insertAdjacentHTML('beforebegin', script.innerHTML);
    }
  }
  function _mediaQueryHandler() {
    var breakpoint_attribute = script.getAttribute("data-breakpoint");
    var breakpoints = breakpoint_attribute.replace(/ /g, "").trim().split(',');

    for (index = 0; index < breakpoints.length; ++index) {
      if (A17.media_query_in_use === breakpoints[index]) _append();
    }
  }
  _mediaQueryHandler();
  $(document).on("media_query_updated", _mediaQueryHandler);
};