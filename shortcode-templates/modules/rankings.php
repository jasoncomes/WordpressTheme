<?php

/*
Title: Rankings
Shortcode: [rankings id="" expand_top="#" expand_all="true|false" preview_top="#"]
Html:
Styleguide: [rankings id="142" expand_top="5" expand_all="" preview_top="5"]
Instructions:
*/

if (empty($id)) {
    return;
}

$template   = get_post_meta($id, 'template', true);
$file       = !empty($template) ? '/' . $template : '/he-rankings-default.php';

include TMPL_DIR . $file;
