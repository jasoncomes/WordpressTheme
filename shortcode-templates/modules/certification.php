<?php

/*
Title: Certification
Shortcode: [certification title="" icon="" float="none|left|right"]Content Goes Here[/certification]
Html:
Styleguide: [certification title="Cop" icon="icon-cap"]<p>copy-60</p>[/certification]
Instructions: Career Item.
*/

// Return.
if (empty($content) && empty($title)) {
    return;
}

use HigherEducation\Pub\PublicHelpers;

$classes = !empty($float) && $float != 'none' ? ' fl-' . $float : '';
$reserve = !empty($reserve) ? ' reserve="1"' : '';

?>

<div class="certification<?php echo $classes; ?>">
    
    <?php 
    if (!empty($icon)) {
        echo do_shortcode('[icon value="' . $icon . '"' . $reserve . ']');
    } 
    ?>
    <h4 class="title"><?php echo $title; ?></h4>
    <div class="content">
        <?php echo $content; ?>
    </div>
    
</div>

