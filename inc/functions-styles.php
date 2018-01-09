<?php

/**
 * Page Styles
 *
 */

add_action('wp_head', function () {

    global $post;
    $styles = '';

    // Return.
    if (empty($post)) {
        return;
    }

    // Page Styles
    if ($post->page_styles) {
        $styles .= $post->page_styles;
    }

    // Mobile Background
    if ($post->page_mobile_background) {
        $styles .= ' body { background-image: url(' . $post->page_mobile_background . '); } ';
    }

    // Background
    if ($post->page_background) {
        if ($post->page_mobile_background) {
            $styles .= ' @media (min-width: 620px) { body { background-image: url(' . $post->page_background . '); }}';    
        } else {
            $styles .= ' body { background-image: url(' . $post->page_background . '); }';
        }        
    }
        
    // Custom Styles
    if (!empty($styles)) {
        echo '<style>' . $styles . '</style>';
    }

});
