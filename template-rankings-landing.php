<?php
/*
Template Name: Rankings Landing
*/

get_header();

?>

<main role="main" class="site-content" id="rankings-landing">
    
    <div class="element-full-width">

        <article id="post-<?php the_ID(); ?>" <?php post_class('wrap'); ?>>
            
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-content"><?php the_content(); ?></div>

        </article>

    </div>

    <div class="columns-aloglia" id="algolia-rankings">

        <!-- Filters -->
        <div class="column">

            <form class="algolia-filters">

                <div id="algolia-searchBox"></div>
                <div id="algolia-currentRefinedValues"></div>

                <div class="filter-section js-target">
                    
                    <div class="filter-control js-toggle"></div>

                    <div class="filter-category is-active">
                        <div class="filter-label filter-expand-header js-toggle-category">Subject</div>
                        <div class="filter-checklist">
                            <div id="algolia-refinementList-subject"></div>
                        </div>
                    </div>

                    <div class="filter-category">
                        <div class="filter-label filter-expand-header js-toggle-category">Degree</div>
                        <div class="filter-checklist">
                            <div id="algolia-refinementList-degree"></div>
                        </div>
                    </div>

                    <div class="filter-category">
                        <div class="filter-label filter-expand-header js-toggle-category">Location</div>
                        <div class="filter-checklist">
                            <div id="algolia-refinementList-study_location"></div>
                        </div>
                    </div>

                </div>

                <div id="algolia-clearAll"></div>

            </form>

        </div>

        <!-- Title/Hits/Pagination -->
        <div class="column">

            <div id="algolia-hits"></div>
            <div class="algolia-pagination" id="algolia-pagination"></div>

        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.js"></script>

<script>

    if (!String.prototype.format) {
        String.prototype.format = function() {
            var args = arguments;
            return this.replace(/{(\d+)}/g, function(match, number) { 
                return typeof args[number] != 'undefined'
                ? args[number]
                : match
                ;
            });
        };
    }

    var sortBy = 'subject';
    var search = instantsearch({
        appId: <?php echo ALGOLIA_APP_ID; ?>,
        apiKey: <?php echo ALGOLIA_API_KEY; ?>,
        indexName: <?php echo ALGOLIA_RANKINGS; ?>,
        urlSync: true,
        searchParameters: {
            filters: 'NOT tags.section: "Honorable Mention" AND active=1',    
        }
    });


    function formatTitle(title, highlight) {
        if (highlight === undefined) {
            return title;
        }

        return title.replace(highlight, '<b>' + highlight + '</b>');
    }

    function buildHTML(data) {
        var html      = '';
        var incSort   = true;
        var rankings  = sortRankings(data.hits, window.sortBy);

        var featuredTemplate = '\
            <li class="{0}">\
                <a href="{3}" title="{2}" class="ranking">\
                    <span class="ribbon">{5}</span>\
                    <img class="featured-image" src="{4}" alt="{2}" />\
                    <h3 class="title">{1}</h3>\
                </a>\
            </li>\
        ';

        var resultTemplate = '\
            <li class="{0}">\
                <a href="{3}" title="{2}" class="ranking">\
                    <span class="ribbon-text">{4}</span>\
                    <h3 class="title">{1}</h3>\
                </a>\
            </li>\
        ';

        if (rankings.featured.length) {
            html += '<div class="rankings-resultset">';
            html += '<h2>Featured</h2>';
            html += '<ul>';

            for(var i = 0; i < rankings.featured.length; i++) {
                html += featuredTemplate.format(
                    'element-postcallout',
                    formatTitle(rankings.featured[i].title, rankings.featured[i].title_highlight),
                    rankings.featured[i].title,
                    rankings.featured[i].ranking_cpt_slug,
                    rankings.featured[i].feat_img.replace('/upload/', '/upload/c_fill,w_382,h_175,q_80/'),
                    rankings.featured[i].tags.study_location,                    
                );
            }

            html += '</ul></div>';
        }

        Object
            .keys(rankings.sorted)
            .sort()
            .forEach(function(title, i) {

            html += '<div class="rankings-resultset">';

            if (incSort) {
                html += '\
                  <div id="rankings-sort">\
                    <span>Sort by</span>\
                    <select>\
                      <option value="subject" ' + (window.sortBy == 'subject' ? 'selected' : '') + '>Subject</option>\
                      <option value="degree" ' + (window.sortBy == 'degree' ? 'selected' : '') + '>Degree</option>\
                      <option value="study_location" ' + (window.sortBy == 'study_location' ? 'selected' : '') + '>Location</option>\
                    </select>\
                    <span class="chev-down"></span>\
                  </div>\
                ';

                incSort = false;
            }

            html += '<h2>' + title.replace('zz', '') + '</h2>';
            html += '<ul>';

            for(var i = 0; i < rankings.sorted[title].length; i++) {
                if (rankings.sorted[title][i].ranking_cpt_slug == '') {
                    continue;
                }

                html += resultTemplate.format(
                    'element-postcallout-text',
                    formatTitle(rankings.sorted[title][i].title, rankings.sorted[title][i].title_highlight),
                    rankings.sorted[title][i].title,
                    rankings.sorted[title][i].ranking_cpt_slug,
                    rankings.sorted[title][i].tags ? rankings.sorted[title][i].tags.study_location : ''
                );
            }        
            html += '</ul></div>';

        });

        return html;
    };


    function sortRankings(hits, sortBy) {
        var sorted        = [];
        var featured      = [];

        for(var i = 0; i < hits.length; i++) {

            if (hits[i].tags && hits[i].tags[sortBy].length > 0) {

                for(var j = 0; j < hits[i].tags[sortBy].length; j++) {

                    if (sorted[hits[i].tags[sortBy][j]] === undefined ) {
                        sorted[hits[i].tags[sortBy][j]] = [];
                    }

                    sorted[hits[i].tags[sortBy][j]].push(hits[i]);
                }
            }
            else {
                // zzMisc because we need Misc to be last, alphabetically
                if (sorted['zzMisc'] === undefined) {
                    sorted['zzMisc'] = [];
                }

                sorted['zzMisc'].push(hits[i]);          
            }

            if (hits[i].tags && hits[i].tags.section.indexOf('Featured') > -1) {
                featured.push(hits[i]);
            }
        }

        return {
            'sorted': sortRankingsAlpha(sorted),
            'featured': sortRankingsAlpha(featured)
        };     
    }

    function sortRankingsAlpha(rankings) {
        for (var key in rankings) {
            if (rankings.hasOwnProperty(key) && rankings[key].length) {
                rankings[key].sort(function(a, b){
                    var titleA = a.title ? a.title.toLowerCase() : ''; 
                    var titleB = b.title ? b.title.toLowerCase() : '';
                    if (titleA < titleB)
                        return -1;
                    if (titleA > titleB)
                        return 1;
                    return 0;
                });
            }
        }

        return rankings;     
    }

    var dropdownClasses = {
        root: 'filter-expand',
        header: 'filter-expand-header',
        body: 'filter-expand-body',
        item: 'filter-expand-item',
        active: 'active',
        count: 'filter-count'
    };

    search.addWidget(
        instantsearch.widgets.hits({
            container: '#algolia-hits',
            templates: {
                empty: 'No results',
                allItems: buildHTML
            },
            hitsPerPage: 250
        })
    );

    search.addWidget(
        instantsearch.widgets.searchBox({
            container: '#algolia-searchBox',
            placeholder: 'Search',
            autofocus: false,
        })
    );

    search.addWidget(
        instantsearch.widgets.refinementList({
            container: '#algolia-refinementList-subject',
            attributeName: 'tags.subject',
            operator: 'or',
            sortBy: ['name:asc'],
            limit: 100,
            cssClasses: dropdownClasses,
            collapsible: {
                collapsed: false
            },
        })
    );

    search.addWidget(
        instantsearch.widgets.refinementList({
            container: '#algolia-refinementList-degree',
            attributeName: 'tags.degree',
            operator: 'or',
            sortBy: ['name:asc'],
            limit: 100,
            cssClasses: dropdownClasses,
            collapsible: {
                collapsed: false
            },
        })
    );

    search.addWidget(
        instantsearch.widgets.refinementList({
            container: '#algolia-refinementList-study_location',
            attributeName: 'tags.study_location',
            operator: 'or',
            sortBy: ['name:asc'],
            limit: 100,
            cssClasses: dropdownClasses,
            collapsible: {
                collapsed: false
            },
        })
    );

    search.addWidget(
        instantsearch.widgets.currentRefinedValues({
            container: '#algolia-currentRefinedValues',
            clearAll: false,
            templates: {
                header: 'Filters Selected'
            },
            attributes: [{
                name: 'tags.study_location',
            }, {
                name: 'tags.degree',
            }, {
                name: 'tags.subject',
            }],        
            onlyListedAttributes: true
        })
    );

    search.addWidget(
        instantsearch.widgets.clearAll({
            excludeAttributes: 'active',
            container: '#algolia-clearAll',
            templates: {
                link: 'Clear All'
            },
            cssClasses: {
                link: 'btn-secondary-green'
            },
            autoHideContainer: true
        })
    );                     

    search.start();

</script>

<?php get_footer(); ?>

<script>
    (function($) {

        $(window).load(function() {

            // Rankings Landing: Order By change
            $('#algolia-hits').on('change', '#rankings-sort select', function() {
                window.sortBy = $(this).val();
                $('#algolia-hits').html(buildHTML(window.search.helper.lastResults));
            });

            // Filters: Label Click
            $('#algolia-rankings').on('click', '.js-toggle-category', function() {
              $(this).closest('.filter-category').toggleClass('is-active');
            });

        });

    })(jQuery);
</script>
