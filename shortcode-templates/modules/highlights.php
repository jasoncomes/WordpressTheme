<?php

/*
Title: Highlights
Shortcode: [highlights title="" expand_top="#" expand_all="true|false" is_numbered="true|false"][highlight title="" active="true|false"]<table class="highlight-table"><tbody><tr><th>Title</th><td>Content Goes Here</td></tr><tr><th>Title</th><td>Content Goes Here</td></tr></tbody></table>[/highlight][highlight title="" active="true|false"]<table class="highlight-table"><tbody><tr><th>Title</th><td>Content Goes Here</td></tr></tbody></table>[/highlight][/highlights]
Html:
Styleguide: [highlights title="Highlights" expand_top="2" expand_all="" is_numbered="true"][highlight title="copy-3" active=""]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-20</td></tr><tr><th>Title</th><td>copy-20</td></tr></tbody></table>[/highlight][highlight title="copy-4" active="true|false"]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-20</td></tr></tbody></table>[/highlight][highlight title="copy-4" active="true|false"]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-20</td></tr></tbody></table>[/highlight][/highlights]
Styleguide_2: [highlights title="Highlights" expand_top="1" expand_all="" is_numbered=""][highlight title="copy-3" active=""]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-20</td></tr><tr><th>Title</th><td>copy-20</td></tr></tbody></table>[/highlight][highlight title="copy-4" active="true|false"]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-20</td></tr></tbody></table>[/highlight][highlight title="copy-4" active="true|false"]<table class="highlight-table"><tbody><tr><th>Title</th><td>copy-20</td></tr></tbody></table>[/highlight][/highlights]
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
$is_numbered         = !empty($is_numbered) && ($is_numbered == 1 || $is_numbered == 'true') ? ' is-numbered' : '';
$count               = 1;
$children_shortcodes = Admin\AdminShortcodes::content_shortcodes_to_array($content);
$collapse_all        = !$expand_all && empty(array_column($children_shortcodes, 'active')) && !$expand_top ? ' is-collapsed-all' : '';

?>

<div class="list highlights js-children-toggle<?php echo $expand_all; ?><?php echo $collapse_all; ?><?php echo $is_numbered; ?>">

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
        echo do_shortcode('[highlight active="' . $is_active . '" title="' . $shortcode['title'] . '"]' . $shortcode['content'] . '[/highlight]');

        $count++;
        unset($shortcode);
    }
    ?>
</div>
