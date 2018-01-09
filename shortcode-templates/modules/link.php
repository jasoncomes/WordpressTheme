<?php

/*
Title: Link
Shortcode: [link title="" subtitle="" image="" url="" type="default|featured"]
Html:
Styleguide: [link title="Scholarships for Minority Students" image="" url="#"]
Styleguide_2: [link title="Scholarships for Minority Students" subtitle="Scholarships" image="" url="#"]
Styleguide_3: [link title="Scholarships for Minority Students" subtitle="Scholarships" image="image-100x100" url="#"]
Styleguide_4: [link title="Scholarships for Minority Students" subtitle="Scholarships" image="image-575x165" url="#" type="featured"]
Instructions:
*/


// Return.
if (empty($url) || empty($title)) {
    return;
}

// Variables.
$subtitle = !empty($subtitle) ? ' data-subtitle="' . $subtitle . '"' : '';
$image = !empty($image) ? ' style="background-image: url(' . $image . ')"' : '';
if (!empty($image)) {
    $type = !empty($type) && $type == 'featured' ? ' type-' . $type : ' type-default';
} else {
    $type = '';
}

echo '<a class="link' . $type . '" href="' . $url . '"' . $image . $subtitle . '>' . $title . '</a>';
