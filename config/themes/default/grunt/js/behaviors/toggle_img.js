/* toggle_dropdown
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.toggle_img = function($img) {
  var $body = $('body');
  var klass = "img__fluid";

  $img.on('click', function(e){
    $body.toggleClass(klass);

    if($body.hasClass(klass)) A17.Util.create_cookie('img', "img__fluid");
    else A17.Util.create_cookie('img', "img__full");
  });
}