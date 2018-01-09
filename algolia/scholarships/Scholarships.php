<?php

namespace Algolia;

class Scholarships
{

    private static $client;
    private static $index;

    public static $appID       = ALGOLIA_APP_ID;
    public static $apiKey      = ALGOLIA_API_KEY;
    public static $indice      = ALGOLIA_SCHOLARSHIPS;
    public static $subject     = false;
    public static $hitsPerPage = 20;


    /*
    * Default atributes to return
    * Update on a per site basis
    */
    private static $attributes = [
        'name',
        'contact',
        'requirements',
        'application_url',
        'deadline',
        'enrollment_levels',
        'renewable',
        'sponsor',
        'study_areas'
    ];


    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets'], 1);
        add_action('wp_footer', [$this, 'inlineFooter'], 20);
    }


    /*
    * Assets - Call External JS/CSS
    *
    */
    public function enqueueAssets()
    {
        wp_enqueue_script('instantsearch_js', 'https://cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.js', null, false, true);
        wp_enqueue_style('instantsearch_css', 'https://cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.css');
    }


    /*
    * Resources - Embed JS
    *
    */
    public function inlineFooter()
    {
        global $shortcodeFacet, $shortcodeStudyAreas;

        $shortcodeStudyAreas = !empty($shortcodeStudyAreas) ? "['" . implode("', '", $shortcodeStudyAreas) . "']" : "false";

        echo "<script>
        var shortcodeStudyAreas = " . $shortcodeStudyAreas . ";
        var hitsPerPage = " . self::$hitsPerPage . ";
        var scholarships_search      = instantsearch({
            appId: '" . self::$appID . "',
            apiKey: '" . self::$apiKey . "',
            indexName: '" . self::$indice . "',
            urlSync: false,
            searchParameters: {
                disjunctiveFacetsRefinements: { " . $shortcodeFacet . " },
                attributesToRetrieve: [ " . self::getAttributes() . " ]
            }
        });";

        foreach ([
            '/algolia/scholarships/helpers.js',
            '/algolia/scholarships/template.js',
            '/algolia/scholarships/common.js',
            '/algolia/scholarships/init.js',
            '/algolia/scholarships/filters.js'
        ] as $file) {
            echo file_get_contents(get_stylesheet_directory() . $file);
        }

        echo "scholarships_search.start() </script>";
    }


    /*
    * Set the AttributesToRequest in the inc-schools.php
    *
    */
    public static function getAttributes()
    {
        return "'" . implode("', '", self::$attributes) . "'";
    }
}
