<?php

/*
Title: Links
Shortcode: [links type="default|featured"][link title="" image="" url=""][link title="" image="" url=""][/links]
Html:
Styleguide: <h4>No Images</h4>[links][link title="copy-7" url="#"][link title="copy-5" url="#"][link title="copy-9" url="#"][link title="copy-5" url="#"][link title="copy-3" url="#"][link title="copy-5" url="#"][/links]
Styleguide_2: <h4>Mix</h4>[links][link title="copy-7" image="image-100x100" url="#"][link title="copy-5" url="#"][link title="copy-9" image="image-100x100" url="#"][link title="copy-5" image="image-100x100" url="#"][link title="copy-3" image="image-100x200" subtitle="Scholarships" url="#"][link type="featured" subtitle="Scholarships" title="copy-5" image="image-575x165" url="#"][/links]
Styleguide_3: <h4>Default</h4>[links type="default"][link title="copy-5" image="image-100x100" url="#"][link title="copy-6" image="image-100x100" url="#"][link title="copy-5" image="image-100x100" url="#"][link title="copy-5" image="image-100x100" url="#"][link title="copy-12" image="image-100x100" url="#"][link title="copy-3" image="image-100x100" url="#"][/links]
Styleguide_4: <h4>Featured</h4>[links type="featured"][link title="copy-5" image="image-575x165" url="#"][link title="copy-5" image="image-575x165" url="#"][link title="copy-5" image="image-575x165" url="#"][link title="copy-5" image="image-575x165" url="#"][link title="copy-5" image="image-575x165" url="#"][link title="copy-5" image="image-575x165" url="#"][/links]
Instructions: 
*/

// Return.
if (empty($content)) {
    return;
}

// Type.
if (!empty($type) && ($type == 'featured' || $type == 'default')) {
    $type    = ' type-' . $type;
    $content = str_replace(['type="default"', 'type="featured"'] , '', $content);
} else {
    $type = '';
}

?>

<div class="links<?php echo $type; ?>">

    <?php echo do_shortcode($content); ?>

</div>
