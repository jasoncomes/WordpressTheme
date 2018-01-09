<?php

/*
Title: Expandables
Shortcode: [expandables expand_top="" expand_all=""][expandable title="" active="true|false"]Content Goes Here[/expandable][expandable title="" active="true|false"]Content Goes Here[/expandable][/expandables]
Html:
Styleguide: [expandables][expandable title="copy-10?" active="1"]copy-40[/expandable][expandable title="copy-5?" active=""]copy-30[/expandable][expandable title="copy-8?" active=""]copy-45[/expandable][/expandables]
Public: 0
Instructions:
*/

// Return.
if (empty($content)) {
    return;
}

$classes  = !empty($expand_top) && is_numeric($expand_top) ? $expand_top : '';
$classes .= !empty($expand_all) && ($expand_all == 1 || $expand_all == 'true') ? ' is-expanded-all' : '';

?>

<div class="items expandables js-children-toggle<?php echo $classes; ?>">

  <?php echo wpautop(do_shortcode($content)); ?>

</div>