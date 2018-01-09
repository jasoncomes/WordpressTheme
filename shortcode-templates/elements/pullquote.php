<?php

/*
Title: Pull Quote
Shortcode: [pullquote float="none|left|center|right" source="" url=""][/pullquote]
Html:
Styleguide: [pullquote float="" source="Test"]With a predicated <a href="#">growth rate of 17%</a> and <a href="#">median salary of $94,500</a>, following this career path can lead to steady, lucrative employment.[/pullquote]copy-40<div class="clearfix"></div><br />
Styleguide_2: <h4>Pull Quote - Centered</h4>copy-40[pullquote float="center" source="Test"]With a predicated <a href="#">growth rate of 17%</a> and <a href="#">median salary of $94,500</a>, following this career path can lead to steady, lucrative employment.[/pullquote]copy-40<div class="clearfix"></div><br />
Styleguide_3: <h4>Pull Quote - Right Aligned</h4>[pullquote float="right" source="Test"]With a predicated <a href="#">growth rate of 17%</a> and <a href="#">median salary of $94,500</a>, following this career path can lead to steady, lucrative employment.[/pullquote]copy-100<div class="clearfix"></div><br />
Styleguide_4: <h4>Pull Quote - Left Aligned</h4>[pullquote float="left" source="Test"]With a predicated <a href="#">growth rate of 17%</a> and <a href="#">median salary of $94,500</a>, following this career path can lead to steady, lucrative employment.[/pullquote]copy-100<div class="clearfix"></div>
Instructions:
*/

$classes = !empty($float) && $float != 'none' ? ' fl-' . $float : '';

?>


<blockquote class="pullquote<?php echo $classes; ?>">

    <p><?php echo $content; ?></p>

    <?php if(!empty($source)) : ?>
        <footer>
            <cite><?php echo !empty($url) ? '<a href="' . $url . '" target="_blank">' . $source . '</a>' : $source; ?></cite>
        </footer>
    <?php endif; ?>

</blockquote>
