// Result Count
scholarships_search.addWidget(
  instantsearch.widgets.stats({
    container: '#algolia-count',
    templates: {
      body: '{{nbHits}} Results'
    }
  })
);

// Pagination
scholarships_search.addWidget(
  instantsearch.widgets.pagination({
    container: '#algolia-pagination',
    scrollTo: '.algolia-scholarships',
    labels: {
      first: 'First',
      previous: 'Previous',
      next: 'Next',
      last: 'Last'
    },
    padding: 2,
    cssClasses: {
      root: 'pagination',
      disabled: 'pagination-disabled',
      active: 'pagination-active'
    }
  })
);

// Filters: clear all
scholarships_search.addWidget(
  instantsearch.widgets.clearAll({
    container: '#algolia-clearAll',
    cssClasses: {
      link: 'btn btn-secondary',
    },
    templates: {
      link: 'Clear All Filters'
    },
    autoHideContainer: true
  })
);