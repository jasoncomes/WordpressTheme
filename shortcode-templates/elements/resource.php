<?php

/*
Title: Resource
Shortcode: [resource title="" excerpt="" url="" background='' icon=""]<table class="resource-table"><thead><tr><th>Column Title</th><th>Column Title</th><th>Column Title</th></tr></thead><tbody><tr><td>Row Content</td><td>Row Content</td><td>Row Content</td></tr></tbody></table>[/resource]
Html:
Styleguide: [resource title="Resource" excerpt="copy-20" url="#" background='image-1100x200/111111/333333' icon='icon-paper']<table class="resource-table"><thead><tr><th>Column Title</th><th>Column Title</th><th>Column Title</th></tr></thead><tbody><tr><td>copy-35</td><td>copy-30</td><td>copy-45</td></tr></tbody></table>[/resource]
Styleguide_2: [resource title="Resource" excerpt="copy-20" url="#" background='image-1100x200/111111/333333' icon='']<table class="resource-table"><thead><tr><th>Column Title</th><th>Column Title</th><th>Column Title</th></tr></thead><tbody><tr><td>copy-35</td><td>copy-30</td><td>copy-45</td></tr></tbody></table>[/resource]
Instructions:
*/

$classes = !empty($style) && $style == 'dark' ? ' style-' . $style : '';
$reserve = !empty($reserve) ? ' reserve="1"' : '';

?>

<div class="resource<?php echo $classes; ?>">

    <?php if ((!empty($title) || !empty($excerpt)) && !empty($background)) : ?>
        <div class="header<?php if (!empty($icon)) { echo ' has-icon'; } ?>"<?php if (!empty($background)) { echo 'style="background-image: url(' . $background . ')"'; } ?>>
            <?php
            if (!empty($icon)) {
                echo do_shortcode('[icon value="' . $icon . '"' . $reserve . ']');
            }

            if (!empty($title)) {
                echo '<h3 class="title">' . $title . '</h3>';
            }
            
            if (!empty($excerpt)) {
                echo '<div class="copy">' . $excerpt . '</div>';
            }

            if (!empty($url)) {
                echo '<a class="btn" href="' . $url . '">Learn More</a>';
            }
            ?>
        </div>
    <?php endif; ?>

    <?php 
    if (!empty($content)) {
        echo '<div class="content">' . $content . '</div>';
    }
    ?>

</div>
