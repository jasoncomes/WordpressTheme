<?php

/**
 * Sitemap
 *
 */

add_filter('the_content', function ($content) {

    // Return
    if (!is_page('sitemap')) {
        return $content;
    }

    // Post Types
    $post_types = get_post_types(['public' => true], 'names');
    unset($post_types['attachment']);

    // Setup Sitemap List
    foreach ($post_types as $post_type => $post_name) {
        
        // Post List
        $list = wp_list_pages([
            'post_type'   => $post_type,
            'depth'       => -1,
            'title_li'    => '',
            'echo'        => 0,
            'sort_column' => 'post_modified, post_title'
        ]);

        // Check - List Exists
        if (empty($list)) {
            continue;
        }

        // Content - Header + List
        $content .= '<h3>' . ucfirst($post_name) . '</h3>';
        $content .= '<ul>';
        $content .= $list;
        $content .= '</ul>';
    }

    // Return
    return $content;
});
