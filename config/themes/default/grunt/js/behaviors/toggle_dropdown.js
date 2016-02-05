/* toggle_dropdown
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.toggle_dropdown = function($el) {
  var $trigger = $el.find('[data-trigger]'),
      $target  = $el.find('[data-dropdown]'),
      klass    = "header__active";

  $trigger.on('click', function(e){
    if($target) {
      $el.toggleClass(klass, !$el.hasClass(klass));

      e.preventDefault();
      e.stopPropagation();
    }
  });

  $('body').on('click.close-dropdown', function(e){
    if($target) $('.' + klass).removeClass(klass);
  });
}