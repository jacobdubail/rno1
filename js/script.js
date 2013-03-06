(function($){

  var $container = $('#blocks'),
      n          = 4,
      mg_blocks  = $(".textwidget .greyscale"),
      getcolcount = function() {

        var w_w = $(window).width();


        if ( w_w <= 480 ) {
          return 1;
        } else if ( w_w <= 765 && w_w > 480 ) {
          return 2;
        } else if ( w_w <= 1100 && w_w > 765) {
          return 3;
        } else {
          return 4;
        }
      };

  n = getcolcount();

  $(mg_blocks.get(Math.floor(Math.random() * mg_blocks.length))).hide().remove();

  $container.imagesLoaded( function() {
    $container.isotope({
      resizable    : false,
      itemSelector : '.project',
      masonry      : { columnWidth: $container.width() / n }
    });
  });

  $(window).smartresize(function(){
    n = getcolcount();

    $container.isotope({
      itemSelector : '.project',
      masonry      : { columnWidth: $container.width() / n }
    });
  });


  $('#filters').on( 'click', 'a', function(e) {
    var $this    = $(this),
        selector = $this.attr('data-filter');
    e.preventDefault();

    $container.isotope({ filter: selector });

    $this
      .addClass('active')
      .parent()
      .siblings()
      .children()
      .removeClass('active');


  });


  $("#vimeo").fitVids();

  $('.carousel').carousel({
    interval: 4000
  })
  .find('.item')
  .on('click', 'img', function() {
    $('.carousel').carousel('next');
  });







})(window.jQuery);