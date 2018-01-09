// Result display
scholarships_search.addWidget(
  instantsearch.widgets.hits({
    container: '#algolia-hits',
    templates: {
      empty: 'Sorry, no results found.',
      item: template
    },
    transformData: {
     item: sanitize_scholarship
    },
    hitsPerPage: hitsPerPage
  })
);