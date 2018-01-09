<?php

/*
Title: Sub Navigation Item
Shortcode: [subnav_item title="" hashtag=""]<h2>Title Goes Here</h2>[/subnav_item]
Html:
Styleguide: [subnav_item title="" hashtag=""]<h2>H2 tags look like this.</h2>[/subnav_item]
Instructions: Title attribute is used for subnavigation title link label.
*/

// Return.
if (empty($content)) {
    return;
}

// Hashtag.
if (empty($hashtag)) {
    $hashtag = !empty($title) ? sanitize_title($title) : sanitize_title(strip_tags($content));
}

?>

<div class="subnav-item" data-waypoint="<?php echo $hashtag; ?>">
    <?php echo $content; ?>
</div>
