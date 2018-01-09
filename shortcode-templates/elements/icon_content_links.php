<?php

/*
Title: Icon + Copy Links Group
Shortcode: [icon_content_links][icon_content_link icon="" title="" url=""][/icon_content_link][icon_content_link icon="" title="" url=""][/icon_content_link][/icon_content_links]
Html:
Styleguide: [icon_content_links][icon_content_link icon="icon-budget" reserve="1" title="Business Intelligence <em>Analyst</em>" url="#"]copy-18[/icon_content_link][icon_content_link icon="icon-business-intelligence" reserve="1" title="Information Security <em>Analyst</em>" url="#"]copy-15[/icon_content_link][icon_content_link icon="icon-computer-systems" reserve="1" title="Computer Systems <em>Analyst</em>" url="#"]copy-12[/icon_content_link][icon_content_link icon="icon-info-security" reserve="1" title="Budget <em>Analyst</em>" url="#"]copy-17[/icon_content_link][/icon_content_links]
Instructions:
*/

// Return.
if (empty($content)) {
    return;
}

?>


<div class="icon-content-links">
    
    <?php echo do_shortcode($content); ?>

</div>
