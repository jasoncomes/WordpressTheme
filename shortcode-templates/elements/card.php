<?php

/*
Title: Card
Shortcode: [card type="none|expert" title="" image="" url="" button_label="" float="none|left|right"]Content Goes Here[/card]
Html:
Styleguide: [card title="<em>Master's In</em> Business Analytics" image="image-300x200" url="#" button_label="Learn More" float=""]copy-20[/card]
Styleguide_2: [card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x300" url="#" button_label="View Interview" float=""]copy-20[/card]
Instructions:
*/

$classes  = !empty($float) && $float != 'none' ? ' fl-' . $float : '';
$classes .= !empty($type) && $type != 'none' ? ' type-' . $type : '';

if (!empty($url)) {
    echo '<a class="card' . $classes . '" href="' . $url . '">';
} else {
    echo '<div class="card' . $classes . '">';
}

if (!empty($image)) {
    echo '<img class="image" src="' . $image . '" />';
}

echo '<div class="card-content">';

if (!empty($title)) {
    echo '<h4 class="title">' . $title . '</h4>';
}

if (!empty($content)) {
    echo '<div class="content">' . $content . '</div>';
}

if (!empty($url)) {
    echo '<span class="btn-tertiary">' . (!empty($button_label) ? $button_label : 'Learn More') . '</span>';
    echo '</div></a>';
} else {
    echo '</div></div>';
}
