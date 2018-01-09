// Filters: Search by name/city
scholarships_search.addWidget(
  instantsearch.widgets.searchBox({
    container: '#algolia-searchBox',
    autofocus: false
  })
);

// Filters: classes for groups of filters
var dropdownClasses = {
  root: 'filter-expand',
  header: 'filter-expand-header',
  body: 'filter-expand-body',
  item: 'filter-expand-item',
  active: 'active',
  count: 'filter-count'
};
var toggleClasses = {
  count: 'filter-count',
  active: 'active'
};

// Filters: States
scholarships_search.addWidget(
  instantsearch.widgets.refinementList({
    container: '#algolia-refinementList-state',
    attributeName: 'states',
    operator: 'or',
    sortBy: ['name:asc', 'count:desc'],
    limit: 99,
    cssClasses: dropdownClasses,
    collapsible: {
      collapsed: false
    },
    transformData: {
      item: stateAbbrToName
    }
  })
);

// Filters: Races
scholarships_search.addWidget(
  instantsearch.widgets.refinementList({
    container: '#algolia-refinementList-races',
    attributeName: 'races',
    operator: 'or',
    sortBy: ['name:asc', 'count:desc'],
    limit: 99,
    cssClasses: dropdownClasses,
    collapsible: {
      collapsed: false
    }
  })
);

// Filters: Min GPA
scholarships_search.addWidget(
  instantsearch.widgets.refinementList({
    container: '#algolia-refinementList-min_gpa',
    attributeName: 'min_gpa',
    operator: 'or',
    sortBy: ['name:desc', 'count:desc'],
    limit: 99,
    cssClasses: dropdownClasses,
    collapsible: {
      collapsed: false
    },
    transformData: {
      item: minGPALabel
    }
  })
);

// Filters: Enrollment Levels
scholarships_search.addWidget(
  instantsearch.widgets.refinementList({
    container: '#algolia-refinementList-enroll_level',
    attributeName: 'enrollment_levels',
    operator: 'or',
    sortBy: ['name:asc', 'count:desc'],
    limit: 99,
    cssClasses: dropdownClasses,
    collapsible: {
      collapsed: false
    }
  })
);

// Filters: Toggles
var toggleFacets = {
  'study_areas' : {
    'accounting': 'Accounting',
    'agriculture' : 'Agriculture',
    'Art' : 'Art',
    'biology' : 'Biology',
    'business' : 'Business',
    'criminal justice' : 'Criminal Justice',
    'computer science' : 'Criminal Justice',
    'education' : 'Education',
    'engineering' : 'Engineering',
    'engineering' : 'Engineering',
    'English' : 'English',
    'finance' : 'Finance',
    'general' : 'General',
    'journalism' : 'Journalism',
    'law' : 'Law',
    'medicine' : 'Medicine',
    'music' : 'Music',
    'nursing' : 'Nursing',
    'occupational therapy' : 'Occupational Therapy',
    'psychology' : 'Psychology',
    'science' : 'Science',
  },
  'renewable' : {
    'Y' : 'Yes',
    'N' : 'No',
  },
  'sponsor.is_school' : {
    'Y' : 'Yes',
    'N' : 'No',
  }
};

// If User defined study_areas isn't included, include it in filters.
if (shortcodeStudyAreas) {
    for (var key in shortcodeStudyAreas) {
      if (!toggleFacets.study_areas[shortcodeStudyAreas[key]]) {
        toggleFacets.study_areas[shortcodeStudyAreas[key]] = capitlizedWords(shortcodeStudyAreas[key]);
      }
    }
}

// Loop Toggle Facets.
for (var facet in toggleFacets) {

  // If empty, skip.
  if (Object.keys(toggleFacets[facet]).length === 0) {
    continue;
  }

  // Selector Container.
  parentID = 'algolia-toggleList-' + facet.replace(/\.|\s/gi, '-');

  // Loop Facet Filters. 
  for (var filter in toggleFacets[facet]) {

    // Create Child DOM Element.
    var toggle       = document.createElement('div');
    toggle.id        = 'algolia-toggle-' + filter.replace(/\.|\s/gi, '-');
    toggle.className = 'check-button';

    // Append Dom Child Element to Selector Container.
    document.getElementById(parentID).appendChild(toggle);

    // Run toggle widget.
    scholarships_search.addWidget(
      instantsearch.widgets.toggle({
        container: '#' + parentID + ' #' + toggle.id,
        attributeName: facet,
        label: toggleFacets[facet][filter],
        values: {
          on: filter
        },
        cssClasses: toggleClasses
      })
    );
  }
}

scholarships_search.addWidget(
  instantsearch.widgets.currentRefinedValues({
      container: '#algolia-currentRefinedValues',
      clearAll: false,
      transformData: {
        item: formatRefineValues
      },
      templates: {
          header: 'Filtering By:'
      },
      attributes: [
        {
          name: 'states',
        }, 
        {
          name: 'study_areas',
        }, 
        {
          name: 'renewable',
        }, 
        {
          name: 'min_gpa',
        }, 
        {
          name: 'sponsor.is_school',
        }, 
        {
          name: 'races',
        }, 
        {
          name: 'enrollment_levels',
        }
      ],        
      onlyListedAttributes: true
  })
);


(function($) {

  $(window).load(function() {
    
    // Filters: Label Click
    $('.filters').on('click', '.js-toggle-category', function() {
      var $target = $(this).closest('.filter-category');

      if ($target.hasClass('is-active')) {
        $target.removeClass('is-active');
      } else {
        $('.filter-category').removeClass('is-active');
        $target.addClass('is-active');
      }
      
    });

  });

})(jQuery);
