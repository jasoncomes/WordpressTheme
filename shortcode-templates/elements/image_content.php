<?php

/*
Title: Image + Copy
Shortcode: [image_content image=""][/image_content]
Html:
Styleguide: [image_content image="image-250x250/000/fff"]<h4>copy-5</h4>copy-50[/image_content][image_content image="image-250x250/000/fff"]<h4>copy-5</h4>copy-150[/image_content][image_content image="image-250x250/000/fff"]<h4>copy-5</h4>copy-50[/image_content]
Instructions:
*/

// Return.
if (empty($image) && empty($content)) {
    return;
}

?>


<div class="image-content">

    <img class="image" src="<?php echo $image; ?>" />
    <?php echo $content; ?>

</div>
