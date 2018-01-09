/**
 * Progress Bar
 */
(function($) {

  if ($('.progress-bar').length) {

    $(document).on('ready', function() {

      // Variables
      var $progressBar = $('.progress-bar'),
        max, value;

      // Progress Bar Build
      var progressBar = function() {
        var winHeight = $(window).height(),
          docHeight = $(document).height();

        max = docHeight - winHeight;
        value = $(window).scrollTop();
        $progressBar.attr('max', max);
        $progressBar.attr('value', value);
      };

      // Jump To On Click
      $($progressBar).click(function(ev) {
        var x = ev.pageX - $(this).offset().left;
        var clickedValue = x * this.max / this.offsetWidth;
        var jumpPosition = Math.floor(clickedValue);
        $('html, body').animate({scrollTop: jumpPosition}, 1000);
      });

      // Initial, Scroll & Window Resize Function Call
      progressBar();
      $(document).on('scroll', progressBar);
      $(window).on('resize', progressBar);

    });

  }

})(jQuery);