<?php

/**
 * Setup Algolia Scholarships with Shortcode/Styleguide Page.
 */
add_action('wp', function()
{
    global $post, $shortcodeFacet, $shortcodeStudyAreas;
    $shortcodeFacet = '';
    $shortcode      = 'scholarships';
    $attribute      = 'study_areas';

    // Return if not $post.
    if (!is_a($post, 'WP_Post')) {
        return;
    }

    // Return if no `$shortcode` and its not the styleguide page.
    if (!has_shortcode($post->post_content, $shortcode) && !is_page('styleguide')) {
        return;
    }

    // Get Shortcode attribute property Value
    if (preg_match_all('/'. get_shortcode_regex() .'/s', $post->post_content, $matches) && 
        array_key_exists(2, $matches) && 
        in_array($shortcode, $matches[2])
    ) {

        // Get `$shortcode` key.
        $index = array_search($shortcode, $matches[2]);

        // Search for `$attribute` values.
        if (!empty($matches[3][$index]) && strpos($matches[3][$index], $attribute) !== false) {
            $value = explode($attribute . '="', $matches[3][$index]);
            $value = substr($value[1], 0, strpos($value[1], '"'));

            // Add to `$attribute` if value exists.
            if (!empty($value)) {
                $shortcodeStudyAreas = explode('|', $value);
                $shortcodeFacet = $attribute . ' : ["' . implode('", "', $shortcodeStudyAreas) . '"]';
            }
        }
    }
    
    include_once 'Scholarships.php';
    new Algolia\Scholarships();
});
