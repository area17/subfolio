/* toggle_dropdown
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.toggle_dropdown = function($el) {
  var $body    = $('body');
      $trigger = $el.find('[data-trigger]'),
      $target  = $body.find('[data-dropdown]'),
      klass    = "header__active";

  $trigger.on('click', function(e){
    var $target  = $body.find('[data-dropdown]');

    if($target.length) {
      $body.toggleClass(klass, !$body.hasClass(klass));
      console.log($('.header').height() - 5)
      $target.css('top', ($('.header').height() - 5) + "px");

      e.preventDefault();
      e.stopPropagation();
    }
  });

  $body.on('click.close-dropdown', function(e){
    $body.removeClass(klass);
  });
}