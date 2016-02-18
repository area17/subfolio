/* toggle_dropdown
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.toggle_dropdown = function($el) {
  var $body    = $('body');
      $trigger = $el.find('[data-trigger]'),
      klass    = "header__active";

  $trigger.on('click', function(e){
    var $target  = $body.find('[data-dropdown]');

    if($target.length) {
      $body.toggleClass(klass, !$body.hasClass(klass));
      _repostion();

      e.preventDefault();
      e.stopPropagation();
    }
  });

  $body.on('click.close-dropdown', function(e){
    $body.removeClass(klass);
  });

  $(document).on("resized", _repostion);

  function _repostion() {
    var $target  = $body.find('[data-dropdown]');
    if($target.length) $target.css('top', ($('.header').height() - 5) + "px");
  }
}