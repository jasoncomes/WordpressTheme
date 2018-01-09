<?php

/*
Title: Scholarships Collection
Shortcode: [scholarships title="" expand_top="#" expand_all="true|false"][scholarship title="" amount=""]Content Goes Here[/scholarship][scholarship title="" amount=""]Content Goes Here[/scholarship][/scholarships]
Html:
Styleguide: [scholarships title="Scholarships Title" expand_top="1" expand_all=""][scholarship title="copy-10" amount="$4,000"]copy-33[/scholarship][scholarship title="copy-3" amount="$3,000"]copy-30[/scholarship][scholarship title="copy-13" amount="$6,000"]copy-60[/scholarship][/scholarships]
Instructions:
*/

// Return.
if (empty($content)) {
    return;
}

// Helper.
use HigherEducation\Admin;

// Variables.
$expand_top          = !empty($expand_top) && is_numeric($expand_top) ? $expand_top : 0;
$expand_all          = !empty($expand_all) && ($expand_all == 1 || $expand_all == 'true') ? ' is-expanded-all' : '';
$count               = 1;
$children_shortcodes = Admin\AdminShortcodes::content_shortcodes_to_array($content);
$collapse_all        = !$expand_all && empty(array_column($children_shortcodes, 'active')) && !$expand_top ? ' is-collapsed-all' : '';

?>

<div class="list scholarships js-children-toggle<?php echo $expand_all; ?><?php echo $collapse_all; ?>">

    <?php if (!empty($title)) : ?>
        <h3 class="header">
            <?php echo $title; ?> 
            <div class="btn-controls">
                <button type="button" class="js-collapse-all">Collapse All</button>
                <button type="button" class="js-expand-all">Expand All</button>
            </div>
        </h3>
    <?php endif; ?>

  <?php
  foreach ($children_shortcodes as $shortcode) {
    // Skip if no title or content.
    if (empty($shortcode['title']) || empty($shortcode['content'])) {
        continue;
    }

    // Is Active.
    $is_active = !empty($shortcode['active']) || $expand_all || $expand_top >= $count ? 1 : '';

    // Child Shortcode.
    echo do_shortcode('[scholarship active="' . $is_active . '" title="' . $shortcode['title'] . '" amount="' . $shortcode['amount'] . '"]' . $shortcode['content'] . '[/scholarship]');

    $count++;
    unset($shortcode);
  }
  ?>

</div>

