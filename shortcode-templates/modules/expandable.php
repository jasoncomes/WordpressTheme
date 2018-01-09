<?php

/*
Title: Expandable
Shortcode: [expandable title="" active="true|false" float="none|left|right"][/expandable]
Html:
Styleguide: [expandable title="copy-6?" active="true" float=""]copy-100[/expandable]
Styleguide_2: [expandable title="copy-6?" active="false" float=""]copy-100[/expandable]
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

<div class="item expandable js-target<?php echo $classes; ?>">  

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