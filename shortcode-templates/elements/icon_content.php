<?php

/*
Title: Icon + Copy
Shortcode: [icon_content icon=""][/icon_content]
Html:
Styleguide: [icon_content icon="icon-coin-stack"]<h4>copy-15</h4>copy-50[/icon_content][icon_content icon="icon-clipboard"]<h4>copy-10</h4>copy-150[/icon_content][icon_content icon="icon-stack"]<h4>copy-5</h4>copy-50[/icon_content]
Instructions:
*/

// Return.
if (empty($icon) && empty($content)) {
    return;
}

$reserve = !empty($reserve) ? ' reserve="1"' : '';

?>


<div class="icon-content">
    
    <?php 
    echo do_shortcode('[icon value="' . $icon . '"' . $reserve . ']');
    echo $content;
    ?>

</div>
