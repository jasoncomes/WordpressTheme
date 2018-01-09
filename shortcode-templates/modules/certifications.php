<?php

/*
Title: Certifications
Shortcode: [certifications][certification title="" icon=""]Content Goes Here[/certification][certification title="" icon=""]Content Goes Here[/certification][/certifications]
Html:
Styleguide: [certifications][certification title="Gamer" icon="icon-cap"]copy-60[/certification][certification title="Teacher" icon="icon-cap"]copy-30[/certification][certification title="Cop" icon="icon-cap"]copy-60[/certification][/certifications]
Instructions:
*/

if (empty($content)) {
    return;
}

?>


<div class="certifications">

    <?php echo do_shortcode($content); ?>

</div>
