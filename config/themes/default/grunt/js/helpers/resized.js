A17.Helpers.resized = function() {
  /*

    # A17.Helpers.resized
    * v.1

    ## description
    What to do on document resize, also checks if current media query has changed

    ## requires
    * A17.Helpers.get_media_query_in_use
    * global variable of: A17.media_query_in_use

    ## parameters
    * name - required - name of parameter value requested
    * url - optional - url to check, otherwise checks current browser url

    ## returns
    * returns value of requested parameter

    ## example usage:
    var user_name = A17.Helpers.get_url_parameter_by_name("user_name")
  */

  $(document).trigger("resized");

  if (!A17.Helpers.get_media_query_in_use) {
    console.log("Missing: A17.Helpers.get_media_query_in_use");
    return false;
  }

  var new_media_query = A17.Helpers.get_media_query_in_use();
  if (A17.media_query_in_use != new_media_query) {
    A17.media_query_in_use = A17.Helpers.get_media_query_in_use();
    // update the image sizes
    $(document).trigger("media_query_updated");
  }

};
