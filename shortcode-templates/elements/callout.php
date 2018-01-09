<?php

/*
Title: Callout
Shortcode: [callout background="" source="" url=""]copy-50[/callout]
Html:
Styleguide: [callout background="image-900x300" source="" url=""]copy-50[/callout]
Instructions:
*/

// Return.
if (empty($content) || empty($background)) {
    return;
}

?>


<blockquote class="callout" style="background-image: url('<?php echo $background; ?>')">

    <p><?php echo $content; ?></p>

    <?php if(!empty($source)) : ?>
        <footer>
            <cite><?php echo !empty($url) ? '<a href="' . $url . '" target="_blank">' . $source . '</a>' : $source; ?></cite>
        </footer>
    <?php endif; ?>

</blockquote>
