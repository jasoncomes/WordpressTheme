<?php

/**
 * He Plugin - Setup
 *
 */
require_once ABSPATH . '../../vendor/autoload.php';

use HigherEducation\Pub;
use HigherEducation\Admin;


if (is_admin()) {

    /**
     * HE Plugin - Initialize Plugin
     */
    (new Admin\AdminACF)->init();
    (new Admin\AdminAppearance)->init();
    (new Admin\AdminHousekeeping)->init();
    (new Admin\AdminMedia)->init();
    (new Admin\AdminPosts)->init();


    /**
     * Metaboxes
     */
    foreach (glob(__DIR__ . '/inc/_metaboxes/*.php') as $filename) {
        require_once $filename;
    }


    /**
     * Disable New Relic for WP Admin
     *
     */
    if (extension_loaded('newrelic')) {
        newrelic_ignore_transaction();
    }


    /**
     * Sitemap Generator
     */
    include_once 'inc/functions-sub-navigation.php';


    /**
     * WP Editor Styles
     */
    add_action('init', function() {
        add_editor_style();
    });
    

} else {

    /**
     * HE Plugin - Constants
     */
    (new Pub\PublicConstants)->init([
        'SATELLITE_URL'          => '//assets.adobedtm.com/73e838b12498fbc88a04286ad6036d82e8fa072e/satelliteLib-41bd6da4fa4e1cd2fb6be77f09dcdbdc8dd7327b.js',
        'VWO_ACCOUNT_ID'         => '728',
        'PUBLISHER'              => 'businessanalytics-com',
        'BRANDED_FORM_URL'       => 'http://forms.businessanalytics.com',
        'WWW_URL'                => home_url('/'),
        'ALGOLIA_APP_ID'         => 'QT4LTISCL1',
        'ALGOLIA_API_KEY'        => 'd0e8d6b8c0a788a3b2810a38c932f92c',
        'ALGOLIA_SCHOLARSHIPS'   => 'he_scholarships_v2.0',
        'ALGOLIA_RANKINGS'       => 'bacom_rankings',
        'ALGOLIA_RANKINGS_ITEMS' => 'bacom_rankings_items',
    ]);


    /**
     * HE Plugin - Initialize Plugin
     */
    (new Pub\PublicPosts)->init();
    (new Pub\PublicErrors)->init();
    (new Pub\PublicYoast)->init();
    (new Pub\PublicView)->init();
    (new Pub\PublicHousekeeping)->init();


    /**
     * Include Assets
     */
    include_once 'inc/functions-assets.php';


    /**
     * Sitemap Generator
     */
    include_once 'inc/functions-sitemap.php';


    /**
     * 410 Error Handler
     */
    include_once 'inc/functions-410.php';


    /**
     * Widgets
     */
    include_once 'inc/functions-archive-titles.php';


    /**
     * Widgets
     */
    include_once 'inc/functions-styles.php';


    /**
     * Algolia Scholarships
     */
     include_once 'algolia/scholarships/wp-action.php';

}


/**
 * Post Types & Taxonomies
 *
 */
(new Admin\AdminPostType)->create_post_type('rankings', [
    'labels'       => ['Ranking', 'Rankings'],
    'supports'     => ['title', 'thumbnail', 'editor', 'author', 'revisions', 'page-attributes'],
    'has_archive'  => false,
    'hierarchical' => true,
    'menu_icon'    => 'dashicons-list-view',
]);

(new Admin\AdminPostType)->create_post_type('resources', [
    'labels'      => ['Resource', 'Resources'],
    'supports'    => ['title', 'thumbnail', 'editor', 'author', 'revisions'],
    'has_archive' => false,
    'menu_icon'   => 'dashicons-admin-page',
]);

(new Admin\AdminTaxonomy)->create_taxonomy('resources-categories', 'resources', [
    'labels' => ['Category', 'Categories']
]);

(new Admin\AdminPostType)->create_post_type('degrees', [
    'labels'      => ['Degree', 'Degrees'],
    'rewrite'     => ['slug' => 'degrees'],
    'supports'    => ['title', 'thumbnail', 'editor', 'author', 'revisions'],
    'has_archive' => false,
    'menu_icon'   => 'dashicons-welcome-learn-more',
]);

(new Admin\AdminPostType)->create_post_type('online-degrees', [
    'labels'      => ['Online Degree', 'Online Degrees'],
    'rewrite'     => ['slug' => 'online-degrees'],
    'supports'    => ['title', 'thumbnail', 'editor', 'author', 'revisions'],
    'has_archive' => false,
    'menu_icon'   => 'dashicons-welcome-learn-more',
]);

(new Admin\AdminPostType)->create_post_type('careers', [
    'labels'       => ['Career', 'Careers'],
    'supports'     => ['title', 'thumbnail', 'editor', 'author', 'revisions', 'page-attributes'],
    'has_archive'  => false,
    'hierarchical' => true,
    'menu_icon'    => 'dashicons-businessman',
]);


/**
 * HE Plugin - Shortcodes
 *
 */
(new Admin\AdminShortcodes)->init();
