<?php
/*
Title: Badge
Shortcode: [badge title="" download='' image='' float="none|left|right"]
Html:
Styleguide: [badge title="Top 10 Bachelor Degrees Badge" download='image-200x200' image='image-300x250' float=""]
Instructions:
*/

// Return.
if (empty($image)) {
    return;
}

// Float.
$classes = !empty($float) && $float != 'none' ? ' fl-' . $float : '';

?>

<div class="badge<?php echo $classes; ?>">

    <?php 
    echo '<img src="' . $image . '"' . (!empty($title) ? ' alt="' . $title . '"' : '') . '/>';

    if (!empty($download)) {
        echo '<a href="' . $download . '" class="btn" download>Download Badge</a>';
    }
    ?>

</div>