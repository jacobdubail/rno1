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


  $(document).bind( 'gform_post_render', function() {

    var $win        = $(window);
    var orientation = ( $win.width() > 767 ) ? "horizontal" : "vertical";

    var $budget = $( "#input_3_32" ).addClass('visuallyhidden');
    var labels  = $( "<ol id='labels' class='"+orientation+"' />" ).insertAfter( $budget );
    var slider  = $( "<div id='slider' />" ).insertAfter( $budget ).slider({
      min: 5000,
      max: 50000,
      step: 5000,
      orientation: orientation,
      value: ( $budget[ 0 ].selectedIndex + 1 ) * 5000,
      slide: function( event, ui ) {
        $budget[ 0 ].selectedIndex = ui.value / 5000 - 1;
      }
    });

    $budget.find("option").each(function() {
      var $this = $(this);
      $("<li>", {
        'data-value': $this.val(),
        text: $this.text()
      }).prependTo(labels);
    });

    labels.on( 'click', 'li', function() {
      var $this = $(this);
      $budget[ 0 ].selectedIndex = $this.data('value') / 5000 - 1;
      $budget.trigger('change');
    });

    $budget.change(function() {
      slider.slider( "value", ( this.selectedIndex + 1 ) * 5000 );
    });

    $win.resize( $.throttle( 250, function() {
      if ( $win.width() > 767 ) {
        orientation = "horizontal";
        labels.removeClass('vertical');
      } else {
        orientation = "vertical";
        labels.addClass('vertical');
      }

      slider.slider( "option", "orientation", orientation );

    }));

    $(".dropdown").each(function() {
      var $this = $(this);
      $("<span />", {
        text: '\u00D7'
      }).addClass('close').appendTo( $this ).on('click', function() {
        $(this).parent().hide();
      });
    });

    $("body").on('click', function(e) {
      //console.log( e.target.nodeName.toLowerCase() );
      var nodeNames = [ 'legend', 'fieldset' ];

      if ( -1 !== $.inArray( e.target.nodeName.toLowerCase(), nodeNames ) ) {
        $(".dropdown").hide();
      }
    });

    $(".lt-ie9 #gform_wrapper_3").on( 'click', 'input:checkbox + label, input:radio + label', function() {
      $(this).prev().toggleClass('checked');
    });



  });







})(window.jQuery);