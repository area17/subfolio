A17.Behaviors.hover_list = function($list) {
  var klass_focused = "list__row--focused";

  $list.find('.list__body').hover(function() {
    $("." + klass_focused, $list).removeClass(klass_focused);
  });
};