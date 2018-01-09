<?php

/*
Title: Intro
Shortcode: [intro image='']Content Goes Here[/intro]
Html:
Styleguide: [intro image='image-100x100/000/fff']<h3>Kristen Johnson</h3><p>For some personal insight into the opportunities an MBA in healthcare management can provide, we spoke with ____ _____, a _____ _____ at _____ _____ who received her MBA degree in Healthcare Management online from Full Sail University. </p>[/intro]
Instructions:
*/

$classes = !empty($image) ? ' has-image' : '';

?>


<div class="intro<?php echo $classes; ?>">

    <?php
    if (!empty($image)) {
        echo '<img class="image" src="' . $image . '" />';  
    } 
    echo do_shortcode($content);
    ?>

</div>
