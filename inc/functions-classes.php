<?php

/**
 * Page Classes
 *
 */

$classes = '';

// Return.
if (empty($post)) {
    return;
}

// Class: Sub Navigation
if ($post->sub_navigation) {
    $classes .= 'has-sub';
}
