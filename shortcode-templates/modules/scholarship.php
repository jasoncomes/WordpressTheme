<?php

/*
Title: Scholarship
Shortcode: [scholarship title="" amount="" active="true|false" float="" url=""]Content Goes Here[/scholarship]
Html:
Styleguide: [scholarship title="copy-13" amount="$6,000" url="#"]copy-60[/scholarship]
Styleguide_2: [scholarship title="copy-13" amount="" url=""]copy-60[/scholarship]
Styleguide_3: [scholarship title="copy-13" amount="$1,000 - $10,000" url=""]copy-60[/scholarship]
Instructions:
*/

// Return.
if (empty($content) || empty($title)) {
    return;
}

// Public Helper.
use HigherEducation\Pub\PublicHelpers;

// Classes.
$classes  = !empty($active) && ($active == 1 || $active == 'true') ? ' is-active' : '';
$classes .= !empty($float) ? ' fl-' . $float : '';
  
?>

<div class="item scholarship js-target<?php echo $classes; ?>">

  <h4 class="title js-toggle<?php if (!empty($amount)) { echo ' has-amount'; } ?>">
        <?php 
        echo $title;
        if (!empty($amount)) {
          echo '<span class="amount">' . $amount . '</span>';
        }
        echo PublicHelpers::get_svg('icon-expand'); 
        ?>
    </h4>
    <div class="content">
        <?php 
        echo $content;
        if (!empty($url)) {
          echo '<a class="btn-tertiary" href="' . $url . '">View Scholarship</a>';
        }
        ?>
    </div>

</div>