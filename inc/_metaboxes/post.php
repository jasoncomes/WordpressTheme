<?php

/**
 * Pages/Posts.
 */
use WordPressMeta\Metabox;

$page = new Metabox();
$page->settings = [
    'title'     => 'Settings',
    'prefix'    => 'page',
    'remove'    => [],
];
$page->fields = [
    'background' => [
        'label'       => 'Background Image',
        'type'        => 'url',
        'placeholder' => 'http://res.cloudinary.com/*',
        'pattern'     => '^http://res.cloudinary.com/.*',
        'instructions' => 'Image Dimensions: 1800px by 600px+'
    ],
    'mobile_background' => [
        'label'       => 'Mobile Background Image',
        'type'        => 'url',
        'placeholder' => 'http://res.cloudinary.com/*',
        'pattern'     => '^http://res.cloudinary.com/.*',
        'instructions' => 'Image Dimensions: 1800px by 600px+'
    ],
    'styles' => [
        'label'       => 'Styles',
        'type'        => 'textarea'
    ],
];
$page->build();
