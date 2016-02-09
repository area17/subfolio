/* Register keypress events on the whole document when search can be triggered
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Helpers.search = function(event) {
  var $search = $('[data-search]');

  if($search.length === 0) return false;

  var $body = $('body');
  var $search_input = $('[data-search-input]');
  var klass_active = "search__active";

  if(event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode >= 96 && event.keyCode <= 105) {
    if(!is_active()) _show_search();
  } else {
    if(27 == event.keyCode) {
      if(is_active()) _hide_search();
    }
  }

  function is_active() {
    return $body.hasClass(klass_active);
  }

  function _show_search() {
    $body.addClass(klass_active);
    $search_input.focus();
  }

  function _hide_search() {
    $body.removeClass(klass_active);
    $search_input.val('');
  }
}