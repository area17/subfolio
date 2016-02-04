/* Masonry style
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––*/
A17.Behaviors.masonry = function($grid) {

  function _mediaQueryHandler() {
    if (A17.media_query_in_use === "small") {
      _killMasonry();
    } else {
      _launchMasonry()
    }
  }

  function _killMasonry() {
    $grid.masonry( 'destroy' );
    $grid.addClass('masoned__finished masoned__canceled');
  }

  function _launchMasonry() {
    $grid.masonry({
      itemSelector: 'li',
      transitionDuration: 0,
      columnWidth:1
    });

    $grid.on('layoutComplete', function() {
      $grid.removeClass('masoned__canceled');
    });
  }

  _mediaQueryHandler();

  // layout Masonry after each image loads
  $grid.imagesLoaded().always( function() {
    $grid.masonry('layout').addClass('masoned__finished');
  });
  $(document).on("media_query_updated", function() {
    _mediaQueryHandler();
  });
}