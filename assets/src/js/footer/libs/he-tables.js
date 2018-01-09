/**
 * Tables - Add data-titles to table cells for mobile
 */
(function($) {

  // Content Tables Only.
  var $tables = $('.entry-content table');

  // Return if not correct window size or if no tables.
  if (!$tables.length) {
    return;
  }

  $tables.each(function(){
    var $table = $(this);
    var $thead = $table.find('thead');
    var $tbody = $table.find('tbody');
    var headText  = [];
    var headCount = 0;

    // Return if no header or body.
    if (!$thead.length || !$tbody.length) {
      return;
    }

    // Table class for styling(if applicable).
    $table.addClass('table-data');

    // th titles.
    $thead.find('th').each(function() {
      var $header = $(this);
      var $text   = $(this).text();
      var colspan = $header[0].hasAttribute('colspan') && $header.attr('colspan') > 1 ? $header.attr('colspan') : 0;

      // Header to array.
      headText[headCount] = $text;

      // th title colspans.
      if (colspan) {
        for (var j = 1; j < colspan; j++) {
          headCount++;
          headText[headCount] = $text;
        }
      }

      // Increment Count
      headCount++;
    });

    // td data attributes.
    $tbody.each(function() {
      $(this).find('tr').each(function() {
        var cellCount = 0;

        $(this).find('th, td').each(function(i) {
          var $cell   = $(this);
          var colspan = $cell[0].hasAttribute('colspan') && $cell.attr('colspan') > 1 ? $cell.attr('colspan') : 0;

          // Add header as data-title.
          $cell.attr('data-title', headText[cellCount]);

          // th title colspans.
          if (colspan) {
            var dataTitleCount = 1;

            for (var j = 1; j < colspan; j++) {
              dataTitleCount++;
              cellCount++;
              
              // If Same Title, skip
              if (headText[cellCount] == headText[cellCount - 1]) {
                dataTitleCount--;
                continue;
              }

              // Add additional titles.
              $cell.attr('data-title-' + dataTitleCount, headText[cellCount]);
            }
          }

          // Increment Count
          cellCount++;
        });
      });
    });

  });

})(jQuery);