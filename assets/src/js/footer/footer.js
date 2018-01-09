/**
 * Triggers: JS Collapse All, JS Expand All, JS Toggle, JS Scroll to, etc
 */
(function($) {

  // Event: Collapse All in Collections
  $('body').on('click', '.js-collapse-all', function() {
    var $this = $(this);
    var $parent = $this.parents('.js-children-toggle');

    $this.text('Collapsed').prop('disabled', true);
    $this.siblings('.js-expand-all').text('Expand All').prop('disabled', false);
    $parent.removeClass('is-expanded-all').addClass('is-collapsed-all');
    $parent.find('.js-target').removeClass('is-active');
  });


  // Event: Expand All in Collections
  $('body').on('click', '.js-expand-all', function() {
    var $this = $(this);
    var $parent = $this.parents('.js-children-toggle');

    $this.text('Expanded').prop('disabled', true);
    $this.siblings('.js-collapse-all').text('Collapse All').prop('disabled', false);
    $parent.removeClass('is-collapsed-all').addClass('is-expanded-all');
    $parent.find('.js-target').addClass('is-active');
  });


  // Event: JS Toggle
  $('body').on('click', '.js-toggle', function() {
    var $this = $(this);

    // If toggles body class using data-bodyclass
    if ($this.attr('data-bodyclass')) {
      $('body').toggleClass($this.data('bodyclass'));
    }

    // Toggle closest .js-target
    $this.closest('.js-target').toggleClass('is-active');
  });


  // Event: Scroll To
  var jumpTo = function(waypoint) {
    var id = waypoint.substr(1);
    var $waypoint = $('#' + id).length ? $('#' + id) : $('[data-waypoint="' + id + '"]');

    if ($waypoint.length) {
      $('body').removeClass('is-active-subnav');
      $('html, body').animate({ scrollTop: $waypoint.offset().top - ($('.nav-sticky-fixed').height() + 15) }, 1000);
    }
  }


  // Existing Hash
  if (window.location.hash.length !== 0) {
    jumpTo(window.location.hash);
  }


  // Scroll To Click
  $('body').on('click', 'a[href^="#"]', function() {
    jumpTo($(this).attr('href'));
  });


  // Event: Sub Navigation - Mouse Leave Trigger
  $('.js-rollout-subnav').on('mouseleave', function() {
    $('body').removeClass('is-active-subnav');
  });


  // Event: Mobile Submenu Children
  $('html').on('click', '.is-active-mobile .menu-item-has-children > a', function(ev) {
    ev.preventDefault();
    $(this).parent('.menu-item-has-children').toggleClass('is-active');
  });

})(jQuery);


/**
 * Rankings Heights
 */
(function($) {

  if ($('.rankings').length) {

    var $ranking_rows = $('.rankings .title');

    // Set Ranking Heights
    var setRankHeights = function() {
      $ranking_rows.each(function(index) {
        var maxHeight = Math.max.apply(null, $(this).map(function() { return $(this).outerHeight(); }).get());
        $(this).siblings().not('.content').outerHeight(maxHeight);
      });
    };

    // Initial & Window Resize Function Call
    setRankHeights();
    $(window).on('resize', setRankHeights);

  }

})(jQuery);

