/* Masonry style
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.masonry = function($grid) {

  $grid.masonry({
    itemSelector: 'li',
    transitionDuration: 0,
    columnWidth: 'li',
    percentPosition: true
  });

  $grid.on('layoutComplete', function() {
    $grid.removeClass('masoned__canceled');
  });

  // layout Masonry after each image loads
  $grid.imagesLoaded().always( function() {
    $grid.masonry('layout').addClass('masoned__finished');
  });
}