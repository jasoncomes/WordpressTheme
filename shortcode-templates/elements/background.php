<?php
/*
Title: Background
Shortcode: [background image="" bgcolor="" fontcolor="" borderbottom="" bordertop="" margintop="" marginbottom=""][/background]
Html:
Styleguide: [background bgcolor="#239de0" fontcolor="#FFFFFF" image='http://res.cloudinary.com/highereducation/image/upload/v1513289402/BusinessAnalytics.com/Homepage/img-careers-bg.png']<h2 class="text-center">Career</h2> <p>copy-40</p> [icon_content_links][icon_content_link icon="icon-budget" reserve="1" title="Business Intelligence <em>Analyst</em>" url="#"]copy-18[/icon_content_link][icon_content_link icon="icon-business-intelligence" reserve="1" title="Information Security <em>Analyst</em>" url="#"]copy-15[/icon_content_link][icon_content_link icon="icon-computer-systems" reserve="1" title="Computer Systems <em>Analyst</em>" url="#"]copy-12[/icon_content_link][icon_content_link icon="icon-info-security" reserve="1" title="Budget <em>Analyst</em>" url="#"]copy-17[/icon_content_link][/icon_content_links][/background]
Styleguide_2: [background bgcolor="blue" fontcolor="white" image='/wp-content/uploads/2017/12/img-careers-bg.png']<h2 class="text-center">Career</h2> <p>copy-40</p>[/background]
Instructions: fontcolor & overlay property accepts hex or color attribute.
*/

// Return.
if (empty($image) && empty($bgcolor) && empty($borderbottom) && empty($bordertop)) {
    return;
}

// Colors.
$styles  = !empty($fontcolor) ? 'color: ' . $fontcolor . ';' : ''; 
$styles .= !empty($bgcolor) ? ' background-color: ' . $bgcolor . ';' : '';
$styles .= !empty($image) ? ' background-image: url(' . $image . ');' : '';
$styles .= !empty($borderbottom) ? ' border-bottom: 1px solid ' . $borderbottom . ';' : ''; 
$styles .= !empty($bordertop) ? ' border-top: 1px solid ' . $bordertop . ';' : ''; 
$styles .= !empty($marginbottom) ? ' margin-bottom: ' . $marginbottom . ';' : ''; 
$styles .= !empty($margintop) ? ' margin-top: ' . $margintop . ';' : ''; 

?>

<div class="background" style="<?php echo $styles; ?>">
    
    <div class="wrapper">

        <?php 
        if (!empty($content)) {
            echo do_shortcode($content);
        }
        ?>

    </div>

</div>