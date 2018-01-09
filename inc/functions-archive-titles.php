<?php

/**
 * Category Titles
 *
 */

add_filter('get_the_archive_title', function ($title) {

    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">Articles by ' . get_the_author() . '</span>' ;
    }

    // Return.
    return $title;
});
