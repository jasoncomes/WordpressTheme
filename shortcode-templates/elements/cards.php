<?php

/*
Title: Card Group
Shortcode: [cards count="#"][card title="" image="" url="" button_label="" float=""][card][card title="" image="" url="" button_label="" float=""][card][/cards]
Html:
Styleguide: [cards count="2"][card title="<em>Master's In</em> Business Analytics" image="image-300x200" url="#" button_label="Read More" float=""]copy-20[/card][card title="<em>Master's In</em> Business Analytics" image="image-300x200" url="#" button_label="Read More" float=""]copy-20[/card][/cards]
Styleguide_2: [cards count="3"][card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x200" url="#" button_label="View Interview" float=""]copy-20[/card][card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x200" url="#" button_label="View Interview" float=""]copy-20[/card][card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x200" url="#" button_label="View Interview" float=""]copy-20[/card][/cards]
Styleguide_3: [cards count="4"][card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x200" url="#" button_label="View Interview" float=""]copy-20[/card][card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x200" url="#" button_label="View Interview" float=""]copy-20[/card][card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x200" url="#" button_label="View Interview" float=""]copy-20[/card][card type="expert" title="Stephanie Jones <em>Software Designer</em>" image="image-300x200" url="#" button_label="View Interview" float=""]copy-20[/card][/cards]
Instructions: Add count="#", accepts values 3 & 4 accross if you don't want 50% width cards.
*/

if (empty($content)) {
    return;
}

$class = !empty($count) ? ' count-' . $count : '';

?>

<div class="cards<?php echo $class; ?>">

    <?php echo do_shortcode($content); ?>

</div>