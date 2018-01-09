<?php

/*
Title: Post Callout
Shortcode: [post_callout title="" post_id="" ribbon="" float="" image="" url=""]
Html:
Styleguide: [post_callout title="copy-5" post_id="2" ribbon="What up" float=""]
Instructions:
*/

// Return.
if (empty($post_id)) {
    return;
}

$title  = !empty($title) ? $title : get_the_title($post_id);
$url    = !empty($url) ? $url : get_permalink($post_id);
$ribbon = !empty($ribbon) ? 'data-ribbon="' . $ribbon . '"' : '';
$image  = !empty($image) ? $image : get_the_post_thumbnail_url($post_id, 'full');
$class  = !empty($float) && $float != 'none' ? ' fl-' . $float : '';

// Return if no image.
if (empty($image)) {
    #return;
}

?>

<a class="post-callout<?php echo $class; ?>" 
   style="background-image: url('https://api.fnkr.net/testimg/350x200/00CED1/FFF/?text=img+placeholder')"
   href="<?php echo $url; ?>" 
   <?php echo $ribbon; ?>>

    <span class="title"><?php echo $title; ?></span>

</a>
