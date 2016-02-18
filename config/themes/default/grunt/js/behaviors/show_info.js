/* Show/Hide the info box
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.show_info = function($info_bt) {
  $info_bt.click(function(el){
    $('#info-box').toggle();
    $info_bt.toggleClass('on')
    $.scrollTo('[data-footer]');
    return false;
  });
}