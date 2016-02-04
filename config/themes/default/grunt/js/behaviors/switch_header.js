/* Show/Hide the header + cookie
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.switch_header = function($homeSwitch) {

  var $header = $('#header'),
      klass_show = "show",
      klass_hide = "hide";
  var collapse_header_label = 'collapse header';
  var expand_header_label = 'expand header';

  $homeSwitch.click(function(e) {
    if ($homeSwitch.html() == expand_header_label) {
      $homeSwitch.addClass(klass_hide).removeClass(klass_show);
      $homeSwitch.html(collapse_header_label);
      $header.show();
      A17.Util.create_cookie('header', klass_show);
      return false;
    } else {
      $homeSwitch.addClass(klass_show).removeClass(klass_hide);
      $homeSwitch.html(expand_header_label);
      $header.hide();
      A17.Util.create_cookie('header', klass_hide);
      return false;
    }
  });
}