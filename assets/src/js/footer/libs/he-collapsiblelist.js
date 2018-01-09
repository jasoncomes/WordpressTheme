/**
 * Collapsible List - Accordian, Horizontal Tab, Vertical Tab
 *
 */
(function($) {

  if ($('.collapsible').length) {

    // Open First Item for each list
    $('.collapsible').each(function() {

      var $definitionList = $(this);

      if (!$definitionList.find('.collapsible-title.is-active').length) {
        $definitionList.find('.collapsible-title').eq(0).addClass('is-active');
      }

    });

    // Expand/Collapse
    $('.collapsible').on('click', '.collapsible-title', function() {

      var $title = $(this);

      if ($title.parents('.collapsible').hasClass('type-accordion')) {
        $title.toggleClass('is-active');
      } else {
        $title.addClass('is-active').siblings('.collapsible-title').removeClass('is-active');
      }

    });

    // Expand All -- Accordion Style Only
    $('.js-collapsible-expand-all').on('click', function(ev) {

      ev.preventDefault();
      $(this).parents('.collapsible-controls')
        .next('.type-accordion')
        .find('.collapsible-title')
        .addClass('is-active');

    });

    // Collapse All -- Accordion Style Only
    $('.js-collapsible-collapse-all').on('click', function(ev) {

      ev.preventDefault();
      $(this).parents('.collapsible-controls')
        .next('.type-accordion')
        .find('.collapsible-title')
        .removeClass('is-active');

    });

  }

})(jQuery);