<?php


/**
 * Sticky Navigation Build
 */
function build_sub_navigation($post_id, $post, $update)
{
    remove_action('save_post', 'build_sub_navigation', 15, 3);

    if (preg_match_all('/\[subnav_item(.*?)\](.*?)\[\/subnav_item\]/s', $post->post_content, $matches)) {
        $sub_nav = [sanitize_title($post->post_title) => $post->post_title];

        foreach ($matches[0] as $key => $match) {
            preg_match('/title\=\"(.*?)\"/', $match, $attributes_title);
            preg_match('/hashtag\=\"(.*?)\"/', $match, $attributes_hash);

            $title          = mb_convert_encoding(strip_tags($matches[2][$key]), 'HTML-ENTITIES', 'UTF-8');
            $title          = !empty($attributes_title[1]) ? $attributes_title[1] : $title;
            $hash           = !empty($attributes_hash[1]) ? $attributes_hash[1] : sanitize_title($title);
            $sub_nav[$hash] = trim($title);
        }

        update_post_meta($post_id, 'sub_navigation', serialize($sub_nav));
    } else {
        delete_post_meta($post_id, 'sub_navigation');
    }

    add_action('save_post', 'build_sub_navigation', 15, 3);
}
add_action('save_post', 'build_sub_navigation', 15, 3);
