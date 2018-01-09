<?php

/*
Title: Highlight
Shortcode: [highlight title="" active="true|false" float="none|left|right"]<table class="highlight-table"><tbody><tr><th>Title</th><td>Content Goes Here</td></tr></tbody></table>[/highlight]
Html:
Styleguide: [highlight title="copy-6" active="false" float=""]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-60</td></tr></tbody></table>[/highlight]
Styleguide_2: [highlight title="copy-8" active="true" float=""]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-70</td></tr><tr><th>Title</th><td>copy-30</td></tr></tbody></table>[/highlight]
Instructions:
*/

// Return.
if (empty($content) || empty($title)) {
    return;
}

// Public Helper.
use HigherEducation\Pub\PublicHelpers;

// Classes.
$classes  = !empty($active) && ($active == 1 || $active == 'true') ? ' is-active' : '';
$classes .= !empty($float) ? ' fl-' . $float : '';

?>

<div class="item highlight js-target<?php echo $classes; ?>">  

    <h4 class="title js-toggle">
        <?php 
        echo $title;
        echo PublicHelpers::get_svg('icon-expand'); 
        ?>
    </h4>
    <div class="content">
        <?php echo $content; ?>
    </div>

</div>