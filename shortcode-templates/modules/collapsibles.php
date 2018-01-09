<?php

/*
Title: Collapsible List
Shortcode: [collapsibles type="tabs-horizontal|tabs-vertical"][collapsible title=""]Content here[/collapsible][/collapsibles]
Html:
Styleguide: <h4>Collapsible - Tabs Horizontal</h4>[collapsibles type="tabs-horizontal"][collapsible title="copy-2" icon=""]copy-230[/collapsible][collapsible active="true" title="List Item 2" icon=""]copy-100[/collapsible][collapsible title="List Item 3" icon="icon-award"]copy-140[/collapsible][/collapsibles]<br />
Styleguide_2: <h4>Collapsible - Tabs Vertical</h4>[collapsibles type="tabs-vertical"][collapsible title="List Item 1" icon="icon-star-solid"]copy-40[/collapsible][collapsible title="copy-2" icon=""]copy-100[/collapsible][collapsible active="true" title="List Item 3" icon=""]copy-127[/collapsible][/collapsibles]
Instructions: Vertical Tabs Max 10, Horizontal Tabs Max 5. Converts to Accordion beyond these Max Numbers.
*/

// Return.
if (empty($content)) {
    return;
}

$type  = !empty($type) && $type == 'tabs-horizontal' ? 'type-' . $type : 'type-vertical';
$count = substr_count($content, '[/collapsible]');

// Convert to Accordian if List Count Exceeds Design Max
if (($type == 'type-tabs-horizontal' && $count > 5) || ($type == 'type-tabs-vertical' && $count > 10)) {
    $type = 'type-accordion';
}

?>

<dl class="collapsible <?php echo $type; ?>" data-count="<?php echo $count; ?>">

    <?php echo do_shortcode($content); ?>

</dl>
