<?php

/*
Title: Collapsible
Shortcode: [collapsible title="" icon=""]Content here[/collapsible_item]
Html:
Styleguide: hidden
Instructions:
*/

// Return.
if (empty($title) || empty($content)) {
    return;
}

use HigherEducation\Pub\PublicHelpers;

// Variables.
$class   = !empty($active) ? ' is-active' : '';
$reserve = !empty($reserve) ? ' reserve="1"' : '';

?>

<dt class="collapsible-title<?php echo $class; ?>">

    <?php
    if (!empty($icon)) {
        echo do_shortcode('[icon value="' . $icon . '"' . $reserve . ']');
    } 
    echo $title;
    echo PublicHelpers::get_svg('icon-expand'); 
    ?>

</dt>

<dd class="collapsible-content">
    <?php echo wpautop(do_shortcode($content)); ?>
</dd>
