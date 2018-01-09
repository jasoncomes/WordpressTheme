<?php

/*
Title: Icon + Copy Link
Shortcode: [icon_content_link icon="" title="" url=""][/icon_content_link]
Html:
Styleguide: [icon_content_link icon="icon-budget" reserve="1" title="Business Intelligence <em>Analyst</em>" url="#"]copy-50[/icon_content_link][icon_content_link icon="icon-business-intelligence" reserve="1" title="Information Security <em>Analyst</em>" url="#"]copy-150[/icon_content_link][icon_content_link icon="icon-computer-systems" reserve="1" title="Computer Systems <em>Analyst</em>" url="#"]copy-50[/icon_content_link][icon_content_link icon="icon-info-security" reserve="1" title="Budget <em>Analyst</em>" url="#"]copy-50[/icon_content_link]
Instructions:
*/

// Return.
if (empty($url) || empty($content)) {
    return;
}

// Variables.
$reserve = !empty($reserve) ? ' reserve="1"' : '';

?>


<a class="icon-content-link" href="<?php echo $url; ?>">
    
    <?php 
    echo do_shortcode('[icon value="' . $icon . '"' . $reserve . ']');
    echo '<h4 class="title">' . $title . '</h4>';
    echo $content;
    ?>

</a>
