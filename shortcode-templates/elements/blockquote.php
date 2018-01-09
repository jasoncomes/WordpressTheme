<?php

/*
Title: Blockquote
Shortcode: [blockquote source="" url=""][/blockquote]
Html:
Styleguide: [blockquote source="Test"]copy-40[/blockquote]
Instructions:
*/


?>


<blockquote class="blockquote">

    <p>
        <?php 
        echo $content;
        if(!empty($source)) {
            echo ' <cite>' . (!empty($url) ? '<a href="' . $url . '" target="_blank">' . $source . '</a>' : $source) . '</cite>';
        }
        ?>
    </p>

</blockquote>
