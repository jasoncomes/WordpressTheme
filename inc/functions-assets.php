<?php

/**
 * Assets: Local/Staging/Production Environment
 *
 */

add_action('wp_enqueue_scripts', function () {
    /**
     * Deregister Jquery - Add to Footer
     *
     */
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, true);
    wp_enqueue_script('jquery');


    /**
     * Local Environment
     *
     */
    if (WP_ENV == 'local') {
        wp_enqueue_style('bacom-theme-styles', SS_URI . '/assets/dev/style.css', false, null, 'all'); // Theme styles
        wp_enqueue_script('bacom-theme-scripts', SS_URI . '/assets/dev/footer.js', ['jquery'], null, true); // Footer Scripts
        return;
    }


    /**
     * Production/Staging Environment
     *
     */
    wp_enqueue_style('bacom-theme-styles', SS_URI . '/assets/dist/style.min.css', false, null, 'all'); // Theme styles
    wp_enqueue_script('bacom-theme-scripts', SS_URI . '/assets/dist/footer.min.js', ['jquery'], null, true); // Footer Scripts
});
